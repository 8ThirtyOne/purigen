<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$PageUrl = '/admin/blog/list.php';
$PageCode = '020301';
$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

if (!$_POST['slug']) {
    $slug = $webhelper->slugify($_POST['title']);
} else {
    $slug = $_POST['slug'];
}

$blog = models\Blog::find('first', ['conditions' => ["slug = '$slug'"]]);
if ($blog) {
    $webhelper->AlertMessageAndHistoryBack('Blog slug already exist in database');
}
//file upload
$thumbnail1 = $webhelper->UploadFile('thumbnail1', '/literature/', true);
$thumbnail2 = $webhelper->UploadFile('thumbnail2', '/literature/', true);

$file = $webhelper->UploadFile('up_file', '/literature/');

$_POST['slug'] = $slug;
$_POST += ['thumbnail1' => $thumbnail1['filename'], 'thumbnail2' => $thumbnail2['filename'], 'file_name' => $file['filename'], 'org_file_name' => $file['orgfilename']];


try {
    $blog = \models\Blog::create($_POST);
} catch (\Throwable $e) {
    (new \WebHelper())->AlertMessageAndHistoryBack('Something is wrong!');
}

$webhelper->AlertMessageAndGo('', '/admin/blog/list.php');