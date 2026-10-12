<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
extract($data, EXTR_OVERWRITE);
?>
<!DOCTYPE html><head>
    <title>Core Labs | Purigen Biosystems</title>
    <meta name="description"
          content="Core labs providing Purigen Biosystems Ionic DNA and RNA extraction services."/>
    <link rel="canonical" href="https://www.purigen.8romans.com/resources/core-labs"/>
    <meta http-equiv = "content-language" content = "en">
    <meta content="Core Labs | Purigen Biosystems" property="og:title">
    <meta content="Core Labs | Purigen Biosystems" name="twitter:title">
    <meta content="Purigen Biosystems Core Labs."
          property="og:description">
    <meta content="Purigen Biosystems Core Labs."
          name="twitter:description">
    <meta content="https://www.purigen.8romans.com/images/common/logo-purigen-social.jpg" property="og:image">
    <meta content="https://www.purigen.8romans.com/images/common/logo-purigen-social.jpg" name="twitter:image">
    <meta content="website" property="og:type">
    <meta content="Core Labs | Purigen Biosystems" property="og:site_name">
    <meta content="summary" name="twitter:card">
    <meta content="@purigenbio" name="twitter:site">
    <meta content="1600" property="og:image:width">
    <meta content="400" property="og:image:height">
    <link rel="stylesheet" href="https://use.typekit.net/zok0skc.css">
    <link rel="stylesheet" href="/css/core_labs.css?v=1.5">
    <link rel="stylesheet" href="/css/article.css?v=1.5">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/article.css?v=1">
    <link rel="stylesheet" href="/css/core_labs.css?v=1">
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/header.php') ?>
</head>
    
<div id="container">
        <div class="contents-visual core_labs_hero">
            <article>
                <h2 class="core_lab_article_desc">Labs providing Ionic purification services</h2>
                <p>Core Labs</p>
            </article>
        </div>
        <div id="contents_blog" class="container-fluid">
            <a id="a" style="display:block;position:relative;top:-190px;visibility:hidden;"></a>
            <div class="contents-title">
                <h2>Labs Providing Ionic Purification Services</h2>
                <p class="contents-subtitle" style="font-size: 17px">Purigen Biosystems partners with core labs throughout North America to provide pure DNA and RNA extraction services using the Ionic Purification System, and makes it widely accessible for outsourcing important projects.</p>
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
                                    <a href="<?= $item['url'] ?>" target="_blank"><img src="/files/core_labs/<?= $item['logo_file'] ?>" alt="<?= $item['title'] ?>" width="100%" style="border: solid 3px #efefef" ></a>
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
                                    <a href="<?= $item['url'] ?>" target="_blank" class="read_article button-big up_case" style="width: 185px"><i class="fas fa-hand-point-right"></i> &nbsp; GO TO LAB WEBSITE</a>
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
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php') ?>
