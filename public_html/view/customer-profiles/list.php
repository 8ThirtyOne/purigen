<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

//Parameter
$page = $webhelper->RequestFilter('page', 0, false);

//check parameter
if ($webhelper->isNull($page)) $page = 1;
$PageSize = 8;

$dbhelper->dbOpen();
$sql = 'select * from customer_profiles where status = 1  order by year desc, month desc, day desc';

$List = $dbhelper->RunSQLReturnRowsSub($sql, $page, $PageSize, $TotalCount);
$pageList = $webhelper->getPaging($TotalCount, $page, $PageSize);
$dbhelper->dbClose();
?>
<!DOCTYPE html><head>
    <title>Customer Profiles | Purigen Biosystems</title>
    <meta name="description"
          content="Purigen Biosystems Customer Profiles."/>
    <link rel="canonical" href="https://www.purigenbio.com/customer-profiles"/>
    <meta http-equiv = "content-language" content = "en">
	<meta name="description" content="Purigen's customers around the world are reimagining DNA and RNA extraction methods by using the Ionic Purification System to purify nucleic acid from FFPE, cells, and tissue samples.">
    <meta content="Customer Profiles | Purigen Biosystems" property="og:title">
    <meta content="Customer Profiles  | Purigen Biosystems" name="twitter:title">
    <meta content="Purigen Biosystems customer profiles." property="og:description">
    <meta content="Purigen Biosystems customer profiles." name="twitter:description">
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/article.css?v=1">
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/header.php') ?>
</head>
    
<div id="container">
        <div class="contents-visual blog_hero" style="background-image: url(../images/news/hero-purigen-customer-03d.jpg)">
            <article>
                <h2>What our customers are experiencing with our technology</h2>
                <p style="color: #ffffff">Customer Profiles</p>
            </article>
        </div>
	
	<style>
    #index-feature-bar {background-color: #EEEEEE; padding: 20px; height: auto;}
    #index-feature-bar a {display: flex; justify-content: center; align-items: center;}
    #index-feature-bar img {height: 42px;}
    @media (max-width: 640px) {
        #index-feature-bar a > span {text-align: left;}
        #index-feature-bar a span span {display: block;}
    }
   </style>
	
	<!-- purigen newsletter -->
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/news.php') ?>
    <!--//purigen newsletter -->
		
        <div id="contents_blog" class="container-fluid">
            <div class="contents-title">
                <a id="a" style="display:block;position:relative;top:-140px;visibility:hidden;"></a>
            </div>
            <?php foreach ($List as $key => $item) { ?>
                <div class="row">
                    <div class="article_background col-md-12">
                        <article class="row article_wrapper">
                            <div class="col-md-6 article_left">
                                <div class="article_left_top">
                                    <div class="article_type to_left up_case"><?= Constants::CUSTOMERPROFILE_TYPES[$item['type']] ?></div>
                                    <div style="font-family: 'Roboto-Book'; font-size: 14px; color: #54565a" class="article_date to_right up_case"><?=$webhelper->GetMonthShortName($item['month']) ?> <?= $item['day'] ?>, <?= $item['year'] ?></div>
                                </div>
                                <div class="article_left_bottom">
                                    <a href="/customer-profiles/view/<?= $item['slug'] ?>"><img src="/files/customer_profiles/<?= $item['thumbnail1'] ?>" alt="<?= $item['title'] ?>" width="100%"></a>
                                </div>
                            </div>
                            <div class="col-md-6 article_right">
                                <a href="/customer-profiles/view/<?= $item['slug'] ?>" class="article_title_link"><span class="article_title"><?= $item['title'] ?></span></a>
                                <div class="article_info">
                                    <span class="article_author"><?= $item['author'] ?></span>
                                    <span class="article_separate">|</span>
                                    <span class="article_source"><?= $item['source'] ?></span>
                                </div>
                                <div class="article_desc"><?= $webhelper->subStrWords($item['sub_title'],230) ?></div>
                                <div class="article_read_wrapper">
                                    <a href="/customer-profiles/view/<?= $item['slug'] ?>" class="read_article button-big up_case">READ</a>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            <?php } ?>
            <?= $webhelper->GetPageHtml($pageList, $page, '/customer-profiles', $Parameter."#a", $PageSize) ?>
        </div>
    </div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php') ?>
