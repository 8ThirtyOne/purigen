<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$PageUrl = '/admin/resources/literature-registration/list.php';
$PageCode = '010201';
$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

//Parameter
$page = $webhelper->RequestFilter('page', 0, false);
$searchKey = $webhelper->RequestFilter('searchKey', -1, false);
$order = $webhelper->RequestFilter('order', 0, false);

$firstname = $webhelper->RequestFilter('firstname', 20, false);
$lastname = $webhelper->RequestFilter('lastname', 20, false);
$email = $webhelper->RequestFilter('email', 50, false);
$phone = $webhelper->RequestFilter('phone', 50, false);
$organization = $webhelper->RequestFilter('organization', 100, false);
$job_title = $webhelper->RequestFilter('job_title', 100, false);
$country = $webhelper->RequestFilter('country', 50, false);
$state = $webhelper->RequestFilter('state', 50, false);
$main_application = $webhelper->RequestFilter('main_application', 100, false);
$isreceive = $webhelper->RequestFilter('isreceive', 0, false);
$note = $webhelper->RequestFilter('note', -1, true);
$literature_id = $webhelper->RequestFilter('literature_id', 0, false);

//check parameter
if($webhelper->isNull($firstname)) $webhelper->AlertMessage('Error. Please try again.1');
if($webhelper->isNull($lastname)) $webhelper->AlertMessage('Error. Please try again.2');
if($webhelper->isNull($email)) $webhelper->AlertMessage('Error. Please try again.3');
if($webhelper->isNull($organization)) $webhelper->AlertMessage('Error. Please try again.5');
if($webhelper->isNull($country)) $webhelper->AlertMessage('Error. Please try again.7');
if($webhelper->isNull($state)) $webhelper->AlertMessage('Error. Please try again.8');
if($webhelper->isNull($isreceive)) $isreceive = 0;

if($webhelper->isNull($page)) $page = 1;
if($webhelper->isNull($searchKey)) $searchKey = "";
if($webhelper->isNull($order)) $order = 0;

$Parameter = "?page=$page&searchKey=$searchKey&order=$order";

$dbhelper->dbOpen();
$sql = "insert into registration_from_literature(firstname, lastname, email, phone, organization, job_title, country, state, main_application, isreceive, note, literature_id)
        values ('$firstname', '$lastname', '$email', '$phone', '$organization', '$job_title', '$country', '$state', '$main_application', '$isreceive', '$note', '$literature_id')";
$dbhelper->RunSQL($sql);
$dbhelper->dbClose();

$webhelper->AlertMessageAndGo('', '/admin/resources/literature-registration/list.php' . $Parameter);