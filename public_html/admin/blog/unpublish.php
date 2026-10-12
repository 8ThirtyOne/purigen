<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$PageUrl = '/admin/blog/list.php';
$PageCode = '030201';
$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

//Parameter
$ids = $webhelper->RequestFilterMulti('ids', 0, false);
$page = $webhelper->RequestFilter('page', 0, false);
$searchKey = $webhelper->RequestFilter('searchKey', -1, false);
$order = $webhelper->RequestFilter('order', 0, false);

//check parameter
if(count($ids)<=0) $webhelper->AlertMessage('Error. Please try again.');
if($webhelper->isNull($page)) $page = 1;
if($webhelper->isNull($searchKey)) $searchKey = '';
if($webhelper->isNull($order)) $order = 0;

$Parameter = "?page=$page&searchKey=$searchKey&order=$order";

$id = implode(',', $ids);

$dbhelper->dbOpen();
$sql = "select id from blog where id in( $id )";
$List = $dbhelper->RunSQLReturnRows($sql);

if($List != null && count($List) > 0)
{
    foreach ($List as $row)
    {
        $sql = 'update blog set status = 0 where id = ' . $row['id'];
        $dbhelper->RunSQL($sql);
    }
}
$dbhelper->dbClose();

$webhelper->AlertMessageAndGo('', '/admin/blog/list.php' . $Parameter);