<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$PageUrl = '/admin/news/video/list.php';
$PageCode = '020101';
$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

//Parameter
$type = $webhelper->RequestFilter('type', 0, false);
$year = $webhelper->RequestFilter('year', 4, false);
$month = $webhelper->RequestFilter('month', 2, false);
$day = $webhelper->RequestFilter('day', 2, false);
$title = $webhelper->RequestFilter('title', 200, false);
$body = $webhelper->RequestFilter('body', -1, true);
$videourl = $webhelper->RequestFilter('videourl', 500, false);
$is_opened_registration = $webhelper->RequestFilter('is_opened_registration', 0, false);
$registration_header = $webhelper->RequestFilter("registration_header", -1, true);
$slug = $webhelper->RequestFilter('slug', 100, true);

//check parameter
if($webhelper->isNull($year)) $webhelper->AlertMessage('There is an error in your Year entry. Please try again..');
if($webhelper->isNull($month)) $webhelper->AlertMessage('There is an error in your Month entry. Please try again.');
if($webhelper->isNull($day)) $webhelper->AlertMessage('There is an error in your Day entry. Please try again.');
if($webhelper->isNull($title)) $webhelper->AlertMessage('Error. Please try again.');
if($webhelper->isNull($videourl)) $webhelper->AlertMessage('Error. Please try again.');

if($webhelper->isNull($is_opened_registration)) $is_opened_registration = 0;
if (!$slug){
    $slug = $webhelper->slugify($title);
}

$video = models\Video::find('first', ['conditions' => ["slug = '$slug'"]]);
if ($video){
    $webhelper->AlertMessageAndHistoryBack('Video slug already exist in database');
}

//file upload
$thumbnail1 = $webhelper->UploadFile('thumbnail1', '/video/', true);
$thumbnail2 = $webhelper->UploadFile('thumbnail2', '/video/', true);

$file = $webhelper->UploadFile('up_file', '/video/');

$dbhelper->dbOpen();
$sql = "insert into video(type, year, month, day, title, body, videourl, thumbnail1, thumbnail2, filename, orgfilename, updatedate, is_opened_registration, slug, registration_header) values 
        ('$type', '$year', '$month', '$day', '$title', '$body', '$videourl', '" . $thumbnail1['filename'] . "','" . $thumbnail2['filename'] . "', '" . $file['filename'] . "','" . $file['orgfilename'] . "', now(), '$is_opened_registration', '$slug', '$registration_header)";
$dbhelper->RunSQL($sql);
$dbhelper->dbClose();

$webhelper->AlertMessageAndGo("", "/admin/news/video/list.php");
?>