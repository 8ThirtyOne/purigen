<!DOCTYPE html>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$title = $data['slug'];
try {
    if (!$title) {
        throw new Exception('Post does not exist');
    }
    $post = (object)models\CustomerProfile::find('first', ['conditions' => ["slug = '$title'"]]);
    if (empty((array)$post)) {
        throw new Exception('Post does not exist');
    }
} catch (Exception $e) {
    $webhelper->AlertMessageAndHistoryBack($e->getMessage());
}
$tags = explode(',', $post->tags);

$dbhelper->dbOpen();
$sql = 'select slug from customer_profiles where concat(year,month,day) < ' . $post->year . $post->month . $post->day . ' and status = 1 order by year desc, month desc, day desc limit 1';
$forward = $dbhelper->RunSQLReturnOneRow($sql);

$sql = 'select slug from customer_profiles where concat(year,month,day) > ' . $post->year . $post->month . $post->day . ' and status = 1 order by year, month, day limit 1';
$back = $dbhelper->RunSQLReturnOneRow($sql);
$dbhelper->dbClose();
?><head>

        <title><?= $post->author ?> | Purigen Biosystems</title>
        <meta name="description" content="<?= $post->sub_title ?>"/>
        <link rel='canonical'
              href='https://www.<?= $webhelper->Domain ?>/customer-profiles/view/<?= $post->slug ?>'/>
        <meta charset="utf-8">
        <meta http-equiv = "content-language" content = "en">
        <meta property="og:title" content="<?= $post->title ?>"/>
        <meta property="og:description" content="<?= $post->sub_title ?>"/>
        <meta property="og:url" content='https://www.purigenbio.com/customer-profiles/view/<?= $post->slug ?>'/>
        <link rel="stylesheet" href="/css/article.css?v=1.5">
        <link rel="stylesheet" href="https://use.typekit.net/zok0skc.css">

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/header.php') ?>

</head>

    
    

<div id="container">
        <div class="contents-visual contents-visual-article"
             style="background-image: url('/files/customer_profiles/<?= $post->thumbnail2 ?>'); height: 385px; padding: 0">
        </div>
        <div id="contents">
            <div class="article_view_wrapper">
                <div class="article-control">
                    <a href="<?=$back != null ? '/customer-profiles/view/'.$back['slug'] : '#' ?>" class="article-back" style="border: 0px; box-shadow: none; color: #a2a9ad"><i class="far fa-angle-left"></i>&nbsp; Previous</a>
                    <span class="article_view_title"><?= $post->title ?></span>
                    <a href="<?=$forward != null ? '/customer-profiles/view/' .$forward['slug'] : '#' ?>" class="article-forward" style="border: 0px; box-shadow: none; color: #a2a9ad">Next &nbsp;<i class="far fa-angle-right"></i></a>
                </div>
                <div class="article_view_subtitle"><?= $post->sub_title ?></div>
                <div class="article_view_info">
                    <span></span>
                    <span class="article_author"><?= $post->author ?></span>
                    <span class="article_separate"> on </span>
                    <span class="article_date" style="text-transform: capitalize"><?=ucwords(strtolower($webhelper->GetMonthShortName($post->month))) ?> <?= $post->day ?>, <?= $post->year ?></span>
                </div>
                <div class="article_view_body">
                    <?= $post->body ?>
                </div>
                <div class="article_tags"><span style="font-family: 'Roboto-Bold'">Keywords: </span>
                    <?php foreach ($tags as $tag) { ?>
                        <span class="article_tag"><?= $tag ?></span>
                    <?php } ?>
                </div>
                <div class="article_back">
                    <a href="/customer-profiles/" class="article_back_link up_case">< back to Customer Profiles</a>
                </div>
            </div>
        </div>
    </div>
<script>
    if (screen.width < 640) {
        $('.article_view_title').insertAfter($('.article-control').parent().find('.article-control'));
    }
</script>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php') ?>