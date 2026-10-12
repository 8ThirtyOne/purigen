<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$title = $data['slug'];
try {
    if (!$title) {
        throw new Exception('Post does not exist');
    }
    $post = (object)models\Blog::find('first', ['conditions' => ["slug = '$title'"]]);
    if (empty((array)$post)) {
        throw new Exception('Post does not exist');
    }
} catch (Exception $e) {
    $webhelper->AlertMessageAndHistoryBack($e->getMessage());
}
$tags = explode(',', $post->tags);

$dbhelper->dbOpen();
$sql = 'select slug from blog where concat(year,month,day) < ' . $post->year . $post->month . $post->day . ' and status = 1 order by year desc, month desc, day desc limit 1';
$forward = $dbhelper->RunSQLReturnOneRow($sql);

$sql = 'select slug from blog where concat(year,month,day) > ' . $post->year . $post->month . $post->day . ' and status = 1 order by year, month, day limit 1';
$back = $dbhelper->RunSQLReturnOneRow($sql);
$dbhelper->dbClose();
?><head>

        <title>Blog: <?= $post->title ?></title>
        <meta name="description" content="<?= $post->sub_title ?>"/>
        <link rel='canonical'
              href='https://www.<?= $webhelper->Domain ?>/blogs/view/<?= $post->slug ?>'/>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/css/article.css?v=1.4">

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/header.php') ?>

    </head>

    
    <div id="container">
        <div class="contents-visual contents-visual-article"
             style="background-image: url('/files/literature/<?= $post->thumbnail2 ?>')">
            <article>
                <p class="article_hero_title"><?= $post->title ?></p>
                <p class="article_hero_info">
                    <span class="article_author"><?= $post->author ?></span>
                    <span class="article_separate"> | </span>
                    <span class="article_source"><?= $post->source ?></span>
                </p>
            </article>
        </div>
        <div id="contents">
            <div class="article_view_wrapper">
                <div class="article-control">
                    <a href="<?=$back != null ? '/blogs/view/'.$back['slug'] : '#' ?>" class="article-back">Previous</a>
                    <span class="article_view_title"><?= $post->title ?></span>
                    <a href="<?=$forward != null ? '/blogs/view/' .$forward['slug'] : '#' ?>" class="article-forward">Next</a>
                </div>
                <div class="article_view_subtitle"><?= $post->sub_title ?></div>
                <div class="article_view_info">
                    <span>by </span>
                    <span class="article_author"><?= $post->author ?></span>
                    <span class="article_separate"> on </span>
                    <span class="article_date" style="text-transform: capitalize"><?=ucwords(strtolower($webhelper->GetMonthShortName($post->month))) ?> <?= $post->day ?>, <?= $post->year ?></span>
                </div>
                <div class="article_view_body">
                    <?= $post->body ?>
                </div>
                <div class="article_tags"><span>Tags: </span>
                    <?php foreach ($tags as $tag) { ?>
                        <span class="article_tag"><?= $tag ?></span>
                    <?php } ?>
                </div>
                <div class="article_back">
                    <a href="/blogs" class="article_back_link up_case">< back to blog</a>
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