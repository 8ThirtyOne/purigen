<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();

$PageUrl = "/admin/news/events/list.php";
$PageCode = "030201";
$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

//Parameter
$pkid = $webhelper->RequestFilter("pkid", 0, false);
$page = $webhelper->RequestFilter("page", 0, false);
$searchKey = $webhelper->RequestFilter("searchKey", -1, false);
$order = $webhelper->RequestFilter("order", 0, false);

try {
	if (!$pkid) {
		throw new Exception('pkid must be set');
	}
	$event = models\Events::find($pkid)->to_array();
} catch (Exception $e) {
	$webhelper->AlertMessageAndGo($e->getMessage(), "/admin/news/events/list.php" . $Parameter);
}

//check parameter
if($webhelper->isNull($page)) $page = 1;
if($webhelper->isNull($searchKey)) $searchKey = "";
if($webhelper->isNull($order)) $order = 0;

$Parameter = "?page=$page&searchKey=$searchKey&order=$order";

unset($event['pkid'],$event['thumbnail1'],$event['thumbnail2'],$event['filename'],$event['orgfilename'],$event['regdate']);
$duplicate = new models\Events($event);
$timestamp = date('Y-m-d H:i:s');
$duplicate->updatedate = time();
$duplicate->slug = null;
$duplicate->status = 0;
$duplicate->save();

$webhelper->AlertMessageAndGo("", "/admin/news/events/list.php" . $Parameter);
?>

