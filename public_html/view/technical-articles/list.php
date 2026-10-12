<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
extract($data, EXTR_OVERWRITE);

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

//Parameter
$page = $webhelper->RequestFilter('page', 0, false);

//check parameter
if ($webhelper->isNull($page)) $page = 1;
$PageSize = 4;

?>
<!DOCTYPE html><head>
    <title>Technical Articles | Purigen Biosystems</title>
    <meta name="description"
          content="Technical Articles from Purigen Biosystems."/>
    <link rel="canonical" href="https://www.purigenbio.com/resources/technical-articles"/>
    <meta http-equiv="content-language" content="en">
    <meta content="Technical Articles | Purigen Biosystems" property="og:title">
    <meta content="Technical Articles | Purigen Biosystems" name="twitter:title">
    <meta content="Purigen Biosystems Technical Articles."
          property="og:description">
    <meta content="Purigen Biosystems Technical Articles."
          name="twitter:description">
    <meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" property="og:image">
    <meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" name="twitter:image">
    <meta content="website" property="og:type">
    <meta content="Purigen Biosystems | Nucleic Acid Purification – Pure and Simple" property="og:site_name">
    <meta content="summary" name="twitter:card">
    <meta content="@purigenbio" name="twitter:site">
    <meta content="1600" property="og:image:width">
    <meta content="400" property="og:image:height">
    <link rel="stylesheet" href="https://use.typekit.net/zok0skc.css">
    <link rel="stylesheet" href="/css/article.css?v=1.5">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/article.css?v=1">
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/header.php') ?>
</head>


<div id="container">
    <div class="contents-visual technical_article_hero">
        <article>
            <h2>Automated extraction of pure DNA, RNA and miRNA</h2>
            <p style="color: #427cbf; font-size: 32px">Technical Articles</p>
        </article>
    </div>

    <div id="contents_technical_articles">
        <div id="contents_blog" class="container-fluid">
            <a id="a" style="display:block;position:relative;top:-190px;visibility:hidden;"></a>
            <div class="contents-title">
                <a id="a" style="display:block;position:relative;top:-140px;visibility:hidden;"></a>
                <!--<h2>Technical Articles</h2>-->
            </div>
            <?php foreach ($List as $key => $item) { ?>
                <div class="row">
                    <div class="article_background col-md-12" style="padding-top: 15px">
                        <article class="row article_wrapper">
                            <div class="col-md-6 article_left">
                                <div class="article_left_top">
                                    <div class="article_type to_left up_case"></div>
                                    <div style="font-family: 'Roboto-Book'; font-size: 14px; color: #54565a; padding-top: 32px"
                                         class="article_date to_right up_case"><?= $webhelper->GetMonthShortName($item['month']) ?> <?= $item['day'] ?>
                                        , <?= $item['year'] ?></div>
                                </div>
                                <div class="article_left_bottom">
                                    <a href="/resources/technical-articles/view/<?= $item['slug'] ?>"><img
                                                src="/files/technical_articles/<?= $item['logo_file'] ?>"
                                                alt="<?= $item['title'] ?>" width="100%"></a>
                                </div>
                            </div>
                            <div class="col-md-6 article_right">
                                <a href="/resources/technical-articles/view/<?= $item['slug'] ?>"
                                   class="article_title_link"><span
                                            class="article_title" style="font-size: 26px"><?= $item['title'] ?></span></a>
                                <!--<div class="article_desc"><?= $webhelper->subStrWords($item['subtitle'], 250) ?></div>-->
                                <div class="article_desc" style="padding-top: 15px"><?= $webhelper->subStrWords($item['section_1_desc'], 250) ?></div>
                                <div class="article_read_wrapper">
                                    <a href="/resources/technical-articles/view/<?= $item['slug'] ?>"
                                       class="read_article button-big up_case">READ</a>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            <?php } ?>
			<?= $webhelper->GetPageHtml($pageList, $page, '/resources/technical-articles', $Parameter . "#a", $PageSize) ?>
        </div>
    </div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php') ?>
