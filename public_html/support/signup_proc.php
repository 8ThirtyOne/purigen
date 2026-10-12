<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
 
$webhelper = new WebHelper();
$dbhelper = new dbHelper();
 
//Parameter
$firstname = $webhelper->RequestFilter("firstname", 20, false);
$lastname = $webhelper->RequestFilter("lastname", 20, false);
$email = $webhelper->RequestFilter("email", 50, false);
 
//check parameter
if($webhelper->isNull($firstname)) $webhelper->AlertMessage("Please enter a valid First Name.");
if($webhelper->isNull($lastname)) $webhelper->AlertMessage("Please enter a valid Last Name.");
if($webhelper->isNull($email)) $webhelper->AlertMessage("Please enter a valid Email Address.");

if ($webhelper->isSpam($_POST['qt_hiddenRecaptcha'], $_SERVER['REMOTE_ADDR'])) {
    $webhelper->AlertMessageAndHistoryBack('Error (recaptcha). Access denied.');
}
try {
    $dbhelper->dbOpen();
    $sql = "insert into email_list(firstname, lastname, email) values ('$firstname', '$lastname', '$email')";
    $inserpkid = $dbhelper->RunSQLReturnID($sql);
    $dbhelper->dbClose();

    $url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
    $postData =
        [
            '00N3j00000FB7Jh' =>  'Sign Up for Newsletter',
            'title' => 'Sign up for newsletter',
            'first_name' => $firstname,
            'last_name' => $lastname,
            'email' => $email,
            '00N3j00000FAUwe' => 1,
            'oid' => '00D3j000000hPGJ'
        ];
    \WebHelper::sendPost($url, $postData);

    $subject="Newsletter Sign Up from Web";
    $content = "First Name: " . $firstname . "<br/>" .
               "Last Name: " . $lastname . "<br/>" .
               "Email: " . $email . "<br/>";
    
    $mailhelper = new MailHelper();
    //$mailhelper->sendmail("Han", "cshbi90@gmail.com", $subject, $content, true);
    $mailhelper->sendmailToManger($subject, $content, true);
    $mailhelper = null;
    
} catch (Exception $e) {
    $webhelper->AlertMessageAndHistoryBack($e->getMessage());
}
$webhelper->AlertMessageAndGo('', "/support/thank-you-signup.php?pkid=$inserpkid");
?>