<?php



namespace controllers;



use dbHelper;

use MailHelper;

use models\Question;

use Swift_Message;

use WebHelper;



class QuestionController extends BaseController

{

    /**

     * @var string

     */

    protected $table = 'question';



    /**

     * @var \dbHelper

     */

    protected $dbHelper;



    /**

     * @var \WebHelper

     */

    protected $webHelper;



    /**

     * @var array

     */

    private $dataView = [];



    public function __construct()

    {

        $this->webHelper = $this->dataView['webhelper'] = new WebHelper();

        $this->dbHelper = $this->dataView['dbhelper'] = new dbHelper();



        $this->dataView['PageCode'] = '040401';

        $this->dataView['PageTitle'] = 'Question';

    }



    public function actionSave()

    {

        $isAjax = 0;

        $res = array();

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])

            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            $isAjax = 1;

        }



        $formData = $_POST;

       /* $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".(new \WebHelper())->GetCaptchaSecretKey()."&response=".$formData['que_hiddenRecaptcha']."&remoteip=".$_SERVER['REMOTE_ADDR']);

        $responseKeys = json_decode($response,true);

        if(!$responseKeys['success'])

        {

            echo "https://www.google.com/recaptcha/api/siteverify?secret=".(new \WebHelper())->GetCaptchaSecretKey()."&response=".$formData['que_hiddenRecaptcha']."&remoteip=".$_SERVER['REMOTE_ADDR'];

        }*/



        if ((new \WebHelper())->isSpam($formData['que_hiddenRecaptcha'], $_SERVER['REMOTE_ADDR'])) {

            if ($isAjax) {

               // echo "Error (recaptcha). Access denied.";

                $res['status'] = 0;

                $res['redirect'] =  "";

                $res['message'] = "Error (recaptcha). Access denied.";

                echo json_encode($res);

            } else {

                (new \WebHelper())->AlertMessageAndHistoryBack('Error (recaptcha). Access denied.');

            }

            exit();

        }

        unset($formData['que_hiddenRecaptcha']);

        unset($formData['ClientId']);

        unset($formData['grecaptchaval']);

        unset($formData['g-recaptcha-response']);

        $date = new \DateTime();

        $formData['created_at'] = $date->format('Y-m-d H:i:s');



        if (!$formData['nosales']) {



            try {

                $question = Question::create($formData);

                /// START salesforce



                $url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';

                $postData =

                    [

                        'title' => "Web Lead from Popup Form",

                        'first_name' => $formData['firstname'],

                        'last_name' => $formData['lastname'],

                        'email' => $formData['email'],

                        'company' => $formData['organization'],

                        'city' => $formData['city_type_zip'],

                        'description' => "Question ID: " . $question->id . " Question:" . $formData['question'],

                        'lead_source' => "Website",

                        'oid' => '00D3j000000hPGJ',

                        'debug' => '1',

                        'debugEmail' => 'paul@purigenbio.com'

                        //        'ClientId'

                        //        '00N3j00000FApOt' => $_POST['ClientId']

                    ];



                \WebHelper::sendPost($url, $postData);

                /// END

            } catch (\Throwable $e) {

                if ($isAjax) {

                    //echo "Something is wrong! ".$e;

                    $res['status'] = 0;

                    $res['redirect'] = "";

                    $res['message'] = "Sorry, there is an error. " . $e;

                    echo json_encode($res, true);

                } else {

                    (new \WebHelper())->AlertMessageAndHistoryBack('There is an error.' . $e);

                }

                exit();

            }

        }

        $addSubject = "";

        if (!$formData['frompartner']) {

            $addSubject = "from Destributos";

        }

        $subject = 'Web Lead from Popup Form '.$addSubject;

        $content = 

			"Date/Time: " . $formData['created_at']. "\n" .

			"\n" .

            "First Name: " . $formData['firstname'] . "\n" .

            "Last Name: " . $formData['lastname'] . "\n" .

            "Organization / Institution: " . $formData['organization']. "\n" .

            "City / State or Zip Code: " . $formData['city_type_zip']. "\n" .

            "Email Address: " . $formData['email']. "\n" .

            "Question: " . $formData['question']. "\n" .

            "ID: " . $question->id . "\n" .

            "\n" ;

//        $mailhelper = new MailHelper();

//        $mailhelper->sendmailbToManger($subject, $content, true);

//        $mailhelper = null;





        // Create a message

        $mailListArray = explode( ",", getenv('MAIL_RECIPIENT'));

        $mailBccListArray = explode( ",", getenv('MAIL_BCC'));



        $message = (new Swift_Message($subject))

            ->setFrom([getenv('SMTP_USERNAME') => 'purigenbio.com'])

            ->setTo($mailListArray)

            ->setBcc($mailBccListArray)

            ->setBody($content);



        // Send the message

        $mail = new \lib\Mail();

        //$mail->mailer->send($message);

        if (!$mail->mailer->send($message, $failures))

        {

            if ($isAjax) {

                $res['status'] = 0;

                $res['redirect'] =  "";

                $res['message'] = "Sorry, Something is wrong!";

                echo json_encode($res,true);

               // echo "Sorry, Something is wrong!";

            } else {

                (new \WebHelper())->AlertMessageAndHistoryBack('Sorry, there is an error!');

            }

        }else{

            if ($isAjax) {



                $res['status'] = 1;

                $res['redirect'] =  "/support/thank-you.php";

                $res['message'] = "Thank you for you interest in Purigen! Your question / request has been submitted. We will get back to you shortly.";

                echo json_encode($res,true);



                //(new \WebHelper())->AlertMessageAndGo('', "/support/thank-you-request.php");

               // echo "Thank you for you interest in Purigen! Your question / request has been submitted. We will get back to you shortly.";

            } else {

                (new \WebHelper())->AlertMessageAndGo('', "/support/thank-you.php");

               // (new \WebHelper())->AlertMessageAndHistoryBack('Thank you for you interest in Purigen! Your question / request has been submitted. We will get back to you shortly.');

            }

        }

      // error_log(print_r($mail->mailer,true));





        exit();

    }



}