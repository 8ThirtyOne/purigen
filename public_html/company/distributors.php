<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$page =  $webhelper->RequestFilter('page', 0, false);

if ( $webhelper->isNull($page)) $page = 1;

$PageSize = 8;
$Parameter  = '';

$dbhelper->dbOpen();

$sql = "select * from `partner_core_labs`  where status = 1  order by year desc, month desc, day desc";

$List     = $dbhelper->RunSQLReturnRowsSub($sql, $page, $PageSize, $TotalCount);
$pageList =  $webhelper->getPaging($TotalCount, $page, $PageSize);
$dbhelper->dbClose();

/*

$this->setDataView([

    'PageSize'   => $PageSize,
    'List'       => $List,
    'pageList'   => $pageList,
    'TotalCount' => $TotalCount
]);

*/

//extract($data, EXTR_OVERWRITE);

?>

<!DOCTYPE html><head>

    <title>Distributors | Purigen Biosystems</title>

    <meta name="description"
          content="Distributors of Purigen Biosystems Ionic Purification System and Kits."/>
    <link rel="canonical" href="https://www.purigenbio.com/resources/core-labs"/>
    <meta http-equiv = "content-language" content = "en">
    <meta content="Distributors | Purigen Biosystems" property="og:title">
    <meta content="Distributors | Purigen Biosystems" name="twitter:title">
    <meta content="Purigen Biosystems Distributors."
          property="og:description">
    <meta content="Purigen Biosystems Distributors."
          name="twitter:description">
    <meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" property="og:image">
    <meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" name="twitter:image">
    <meta content="website" property="og:type">
    <meta content="Distributors | Purigen Biosystems" property="og:site_name">
    <meta content="summary" name="twitter:card">
    <meta content="@purigenbio" name="twitter:site">
    <meta content="1600" property="og:image:width">
    <meta content="400" property="og:image:height">
    <link rel="stylesheet" href="https://use.typekit.net/zok0skc.css">
    <link rel="stylesheet" href="/css/core_labs.css?v=1.5">
    <link rel="stylesheet" href="/css/article.css?v=1.5">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/article.css?v=1">
    <link rel="stylesheet" href="/css/distributors.css<?php echo "?v=".date("YmdGis"); ?>">

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/header.php") ?>
</head>

    

<div id="container">

        <div class="contents-visual core_labs_hero" style="background-image: url(../images/distributors/hero-purigen-distributor-03h.jpg)">
            <article>
                <h2 class="core_lab_article_desc">Purigen Biosystems</h2>
                <p>Distributors</p>

            </article>

        </div>

        <div id="contents_blog" class="container-fluid">

            <a id="a" style="display:block;position:relative;top:-190px;visibility:hidden;"></a>

            <div class="contents-title">

                <h2>Distributors of Purigen Products and Services</h2>

                <p class="contents-subtitle" style="font-size: 17px">Companies that distribute, service, and support Purigen’s automated Ionic® Purification System and Kits.</p>

            </div>

            <?php foreach ($List as $key => $item) { ?>

                <div class="row">
                    <div class="article_background col-md-12">
                        <article class="row article_wrapper">
                            <div class="col-md-6 article_left">
                                <div class="article_left_top">
                                    <div class="article_type to_left up_case"><?= $item['organization'] ?></div>
                                </div>

                                <div class="article_left_bottom">
                                    <a href="<?= $item['url'] ?>" target="_blank"><img src="/files/partner_core_labs/<?= $item['logo_file'] ?>" alt="<?= $item['title'] ?>" width="100%" style="border: solid 3px #efefef" ></a>
                                </div>
                            </div>

                            <div class="col-md-6 article_right" >
								<a href="<?= $item['url'] ?>" target="_blank" class="article_title_link"><span class="core_lab_main"><?= $item['organization'] ?></span></a>
                                <a href="<?= $item['url'] ?>" target="_blank" class="article_title_link"><span class="article_title core_lab_title"><?= $item['department'] ?></span></a>
                                    <div class="core_contact_info">contact info</div>
                                    <div class="core_contact_name"><?= $item['contact_name'] ?></div>
                                    <div class="core_contact_title"><?= $item['title'] ?></div>
                                <div class="core_lab_info">

                                    <div>
                                        <div class="title">Phone:</div>
                                        <div class="value"><?= $item['phone'] ?></div>
                                    </div>

                                    <div>
                                        <div class="title">Email:</div>
                                        <div class="value"><?= $item['email'] ?></div>
                                    </div>

                                </div>

                                    <div class="article_desc" style="margin-bottom: 10px"></div>
                                    <div class="article_read_wrapper">
                                    <a href="<?= $item['url'] ?>" target="_blank" class="read_article button-big up_case" style="width: 185px"><i class="fas fa-hand-point-right"></i> &nbsp; GO TO WEBSITE</a>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            <?php } ?>

            <?= $webhelper->GetPageHtml($pageList, $page, '/resources/technical-articles', $Parameter . "#a", $PageSize) ?>

        </div>
    </div>

<br><br><br>

<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/include/footer.php")

?>