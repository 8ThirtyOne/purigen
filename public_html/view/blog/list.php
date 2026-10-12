<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

//Parameter
$page = $webhelper->RequestFilter('page', 0, false);

//check parameter
if ($webhelper->isNull($page)) $page = 1;
$PageSize = 4;

$dbhelper->dbOpen();
$sql = 'select * from blog where status = 1  order by year desc, month desc, day desc';

$List = $dbhelper->RunSQLReturnRowsSub($sql, $page, $PageSize, $TotalCount);
$pageList = $webhelper->getPaging($TotalCount, $page, $PageSize);
$dbhelper->dbClose();
?>
<!DOCTYPE html><head>
    <title>Blogs | Purigen Biosystems</title>
    <meta name="description"
          content="Blog Purigen Biosystems."/>
    <link rel="canonical" href="https://www.purigenbio.com/blogs"/>
    <meta content="Blogs | Purigen Biosystems" property="og:title">
    <meta content="Blogs | Purigen Biosystems" name="twitter:title">
    <meta content="Purigen Biosystems Blogs."
          property="og:description">
    <meta content="Blog Purigen Biosystems."
          name="twitter:description">
    <meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" property="og:image">
    <meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" name="twitter:image">
    <meta content="website" property="og:type">
    <meta content="Purigen Biosystems | Nucleic Acid Purification – Pure and Simple" property="og:site_name">
    <meta content="summary" name="twitter:card">
    <meta content="@purigenbio" name="twitter:site">
    <meta content="1600" property="og:image:width">
    <meta content="400" property="og:image:height">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/article.css?v=1">
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/header.php') ?>
</head>
    
<div id="container">
        <div class="contents-visual blog_hero">
            <article>
                <h2>This is what's happening in the purification world...</h2>
                <p>Purigen Blogs</p>
            </article>
        </div>
        <div id="contents_blog" class="container-fluid">
            <div class="contents-title">
                <h2>Top Posts</h2>
            </div>
            <?php foreach ($List as $key => $item) { ?>
                <div class="row">
                    <div class="article_background col-md-12">
                        <article class="row article_wrapper">
                            <div class="col-md-6 article_left">
                                <div class="article_left_top">
                                    <div class="article_type to_left up_case"><?= Constants::BLOG_TYPES[$item['type']] ?></div>
                                    <div class="article_date to_right up_case"><?=$webhelper->GetMonthShortName($item['month']) ?> <?= $item['day'] ?>, <?= $item['year'] ?></div>
                                </div>
                                <div class="article_left_bottom">
                                    <a href="/blogs/view/<?= $item['slug'] ?>"><img src="/files/literature/<?= $item['thumbnail1'] ?>" alt="<?= $item['title'] ?>" width="100%"></a>
                                </div>
                            </div>
                            <div class="col-md-6 article_right">
                                <a href="/blogs/view/<?= $item['slug'] ?>" class="article_title_link"><span class="article_title"><?= $item['title'] ?></span></a>
                                <div class="article_info">
                                    <span class="article_author">by <?= $item['author'] ?></span>
                                    <span class="article_separate">|</span>
                                    <span class="article_source"><?= $item['source'] ?></span>
                                </div>
                                <div class="article_desc"><?= $webhelper->subStrWords($item['sub_title'],230) ?></div>
                                <div class="article_read_wrapper">
                                    <a href="/blogs/view/<?= $item['slug'] ?>" class="read_article button-big up_case">READ</a>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            <?php } ?>
            <?= $webhelper->GetPageHtml($pageList, $page, '/blogs', $Parameter, $PageSize) ?>
        </div>
    </div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php') ?>
