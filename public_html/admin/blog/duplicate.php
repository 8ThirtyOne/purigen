<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();

$PageUrl = '/admin/blog/list.php';
$PageCode = '030201';
$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

//Parameter
$id = $webhelper->RequestFilter('id', 0, false);
$page = $webhelper->RequestFilter('page', 0, false);
$searchKey = $webhelper->RequestFilter('searchKey', -1, false);
$order = $webhelper->RequestFilter('order', 0, false);

try {
	if (!$id) {
		throw new Exception('id must be set');
	}
	$blog = models\Blog::find($id)->to_array();
} catch (Exception $e) {
	$webhelper->AlertMessageAndGo($e->getMessage(), '/admin/blog/list.php' . $Parameter);
}

//check parameter
if($webhelper->isNull($page)) $page = 1;
if($webhelper->isNull($searchKey)) $searchKey = '';
if($webhelper->isNull($order)) $order = 0;

$Parameter = "?page=$page&searchKey=$searchKey&order=$order";

unset($blog['id'],$blog['thumbnail1'],$blog['thumbnail2'],$blog['file_name'],$blog['org_file_name'],$blog['created_at']);
$duplicate = new models\Blog($blog);
$timestamp = date('Y-m-d H:i:s');
$duplicate->created_at = time();
$duplicate->slug = null;
$duplicate->status = 0;
try{
	$duplicate->save();
} catch (Exception $e) {
	var_dump($e);
}

$webhelper->AlertMessageAndGo('', '/admin/blog/list.php' . $Parameter);

