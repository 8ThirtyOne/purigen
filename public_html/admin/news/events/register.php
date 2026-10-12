<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$PageUrl = "/admin/news/events/list.php";
$PageCode = "030201";
$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

//Parameter
$type = $webhelper->RequestFilter("type", 0, false);
$startyear = $webhelper->RequestFilter("startyear", 4, false);
$startmonth = $webhelper->RequestFilter("startmonth", 2, false);
$startday = $webhelper->RequestFilter("startday", 2, false);
$endyear = $webhelper->RequestFilter("endyear", 4, false);
$endmonth = $webhelper->RequestFilter("endmonth", 2, false);
$endday = $webhelper->RequestFilter("endday", 2, false);
$maintitle = $webhelper->RequestFilter("maintitle", 200, false);
$subtitle = $webhelper->RequestFilter("subtitle", -1, true);
$url = $webhelper->RequestFilter("url", 100, true);
$map_url = $webhelper->RequestFilter("map_url", 100, true);
$more_info_url = $webhelper->RequestFilter("more_info_url", 100, true);
$registration_header = $webhelper->RequestFilter("registration_header", -1, true);
$is_opened_registration = $webhelper->RequestFilter("is_opened_registration", 0, false);
$location1 = $webhelper->RequestFilter("location1", 100, true);
$location2 = $webhelper->RequestFilter("location2", 100, true);
$ctabutton1 = $webhelper->RequestFilter("ctabutton1", 100, true);
$ctabutton2 = $webhelper->RequestFilter("ctabutton2", 100, true);
$slug = $webhelper->RequestFilter("slug", 100, true);
$boothnum = $webhelper->RequestFilter("boothnum", 50, false);
$description = $webhelper->RequestFilter("description", -1, true);
$add_info = $webhelper->RequestFilter("add_info", -1, true);

//check parameter
if($webhelper->isNull($type)) $webhelper->AlertMessage("Error. Please try again.");
if($webhelper->isNull($startyear)) $webhelper->AlertMessage("Error. Please try again.");
if($webhelper->isNull($startmonth)) $webhelper->AlertMessage("Error. Please try again.");
if($webhelper->isNull($startday)) $webhelper->AlertMessage("Error. Please try again.");
if($webhelper->isNull($endyear)) $webhelper->AlertMessage("Error. Please try again.");
if($webhelper->isNull($endmonth)) $webhelper->AlertMessage("Error. Please try again.");
if($webhelper->isNull($endday)) $webhelper->AlertMessage("Error. Please try again.");
if($webhelper->isNull($maintitle)) $webhelper->AlertMessage("Error. Please try again.");
if($webhelper->isNull($subtitle)) $webhelper->AlertMessage("Error. Please try again.");
if($webhelper->isNull($location1)) $webhelper->AlertMessage("Error. Please try again.");
if($webhelper->isNull($ctabutton1)) $webhelper->AlertMessage("Error. Please try again. Button 1 title.");
if($webhelper->isNull($ctabutton2)) $webhelper->AlertMessage("Error. Please try again. Button 2 title.");

if($webhelper->isNull($is_opened_registration)) $is_opened_registration = 0;

if (!$slug){
    $slug = $webhelper->slugify($maintitle);
}

$event = models\Events::find('first', ['conditions' => ["slug = '$slug'"]]);
if ($event){
    $webhelper->AlertMessageAndHistoryBack('Event slug already exist in database');
}

//file upload
$thumbnail1 = $webhelper->UploadFile("thumbnail1", "/events/", true);
$thumbnail2 = $webhelper->UploadFile("thumbnail2", "/events/", true);
$file = $webhelper->UploadFile("up_file", "/events/");

$dbhelper->dbOpen();
$sql = "insert into events(type, startyear, startmonth, startday, endyear, endmonth, endday, maintitle, subtitle, url, location1, location2, ctabutton1, ctabutton2, booth, description, thumbnail1, thumbnail2, filename, orgfilename, updatedate, add_info, more_info_url, map_url,slug, registration_header, is_opened_registration) values 
        ('$type', '$startyear', '$startmonth', '$startday', '$endyear', '$endmonth', '$endday', '$maintitle', '$subtitle', '$url', '$location1', '$location2', '$ctabutton1', '$ctabutton2', '$boothnum', '$description',  '" .
        $thumbnail1["filename"] . "', '" . $thumbnail2["filename"] . "', '" . $file["filename"] . "', '" . $file["orgfilename"] . "', now(), '$add_info', '$more_info_url', '$map_url', '$slug', '$registration_header', '$is_opened_registration' )";

$dbhelper->RunSQL($sql);
$dbhelper->dbClose();

$webhelper->AlertMessageAndGo("", "/admin/news/events/list.php");
?>