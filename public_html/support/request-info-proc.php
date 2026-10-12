<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');



$webhelper = new WebHelper();

$dbhelper = new dbHelper();



//Parameter

$firstname = $webhelper->RequestFilter("firstname", 20, false);

$lastname = $webhelper->RequestFilter("lastname", 20, false);

$email = $webhelper->RequestFilter("email", 50, false);

$phone = $webhelper->RequestFilter("phone", 50, false);

$organization = $webhelper->RequestFilter("organization", 100, false);

$job_title = $webhelper->RequestFilter("job_title", 100, false);

$country = $webhelper->RequestFilter("country", 50, false);

$state = $webhelper->RequestFilter("state", 50, false);

$industry_type = $webhelper->RequestFilter("industry_type", 50, false);

$research_type = $webhelper->RequestFilter("research_type", 50, false);

$main_application = $webhelper->RequestFilter("main_application", 100, false);

$purchase_timeline = $webhelper->RequestFilter("purchase_timeline", 100, false);

$isreceive = $webhelper->RequestFilter("isreceive", 0, false);

$note = $webhelper->RequestFilter("note", -1, false);

$grecaptchaval = $webhelper->RequestFilter("grecaptchaval", -1, false);



//check parameter

if($webhelper->isNull($firstname)) $webhelper->AlertMessage("Error. Please try again.");

if($webhelper->isNull($lastname)) $webhelper->AlertMessage("Error. Please try again.");

if($webhelper->isNull($email)) $webhelper->AlertMessage("Error. Please try again.");

if($webhelper->isNull($phone)) $webhelper->AlertMessage("Error. Please try again.");

if($webhelper->isNull($organization)) $webhelper->AlertMessage("Error. Please try again.");

if($webhelper->isNull($job_title)) $webhelper->AlertMessage("Error. Please try again.");

if($webhelper->isNull($country)) $webhelper->AlertMessage("Error. Please try again.");

if($webhelper->isNull($state)) $webhelper->AlertMessage("Error. Please try again.");

if($webhelper->isNull($industry_type)) $webhelper->AlertMessage("Error. Please try again.");

if($webhelper->isNull($research_type)) $webhelper->AlertMessage("Error. Please try again.");

//if($webhelper->isNull($main_application)) $webhelper->AlertMessage("Error. Please try again.");

if($webhelper->isNull($purchase_timeline)) $webhelper->AlertMessage("Error. Please try again.");

if($webhelper->isNull($isreceive)) $isreceive = 0;

if($webhelper->isNull($note)) $webhelper->AlertMessage("Error. Please try again.");



if ($webhelper->isSpam($grecaptchaval, $_SERVER['REMOTE_ADDR'])) {

    $webhelper->AlertMessageAndHistoryBack('Error (recaptcha). Access denied.');

}



$dbhelper->dbOpen();

$sql = "insert into request_information(firstname, lastname, email, phone, organization, job_title, country, state, research_type, main_product, purchase_timeline, isreceive, note, industry_type, main_application)

        values ('$firstname', '$lastname', '$email', '$phone', '$organization', '$job_title', '$country', '$state', '$research_type', '$main_product', '$purchase_timeline', '$isreceive', '$note', '$industry_type', '$main_application')";

$inserpkid =$dbhelper->RunSQLReturnID($sql);

$dbhelper->dbClose();



$url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';

if($research_type == 8){

    $other_research = 'Other specified: ' . $main_application . "<br/>";

    $sf_research = $main_application;

} else {

    $other_research = '';

    $sf_research = '';

}

if ($isreceive == 1){

    $is_receive = 'Yes';

} else {

    $is_receive = 'No';

}



$postData =

    [

        '00N3j00000FB7Jh' => 'Request Information',

        'title' => $job_title,

        'first_name' => $firstname,

        'last_name' => $lastname,

        'email' => $email,

        'phone' => $phone,

        'company' => $organization,

        'member_status' => $job_title,

        'industry' => Constants::INDUSTRY_TYPES[$industry_type],

        //research type-->

        '00N3j00000EpP37' => Constants::RESEARCH_TYPES[$research_type],

        '00N3j00000FAdAy' => $sf_research,

        'country' => $country,

        'state' => $state,

        '00N3j00000FAUwo' => $purchase_timeline,

        '00N3j00000FAUwe' => $isreceive,

        '00N3j00000FALvXEAX' => $note,

        'oid' => '00D3j000000hPGJ',

//        'ClientId'

        '00N3j00000FApOt' => $_POST['ClientId']

    ];

\WebHelper::sendPost($url, $postData);



$subject="Request Information from Web";

$content = "First Name: " . $firstname . "<br/>" .

           "Last Name: " . $lastname . "<br/>" .

           "Email: " . $email . "<br/>" .

           "Phone: " . $phone . "<br/>" .

           "Orgnization / Institution: " . $organization . "<br/>" .

           "Job Title: " . $job_title . "<br/>" .

           "Country: " . $country . "<br/>" .

           "State / Province: " . $state . "<br/>" .

           "Industry Type: " . Constants::INDUSTRY_TYPES[$industry_type] . "<br/>" .

           "Main Application: " . Constants::RESEARCH_TYPES[$research_type] . "<br/>" .

           $other_research .

           "Purchase Timeline: " . $purchase_timeline . "<br/>" .

            "Enews Signup: " . $is_receive . "<br/>" .

           "Request or Question: " . $note . "v";



$mailhelper = new MailHelper();

$mailhelper->sendmailToManger($subject, $content, true);

$mailhelper = null;



$webhelper->AlertMessageAndGo('', "/support/thank-you-request.php?pkid=$inserpkid");