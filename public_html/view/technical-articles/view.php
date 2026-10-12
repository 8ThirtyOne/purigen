<!DOCTYPE html>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
extract($data, EXTR_OVERWRITE);
?><head>

        <title>TECH ARTICLE: <?= $model->title ?></title>
        <meta name="description" content="<?= $model->subtitle ?>"/>
        <link rel='canonical'
              href='https://www.<?= $webhelper->Domain ?>/resources/technical-articles/view/<?= $model->slug ?>'/>
        <meta charset="utf-8">
        <meta http-equiv = "content-language" content = "en">
        <meta property="og:title" content="<?= $model->title ?>"/>
        <meta property="og:description" content="<?= $model->subtitle ?>"/>
        <meta property="og:url" content='https://www.purigenbio.com/resources/technical-articles/view/<?= $model->slug ?>'/>
        <link rel="stylesheet" href="/css/article.css?v=1.5">
        <link rel="stylesheet" href="https://use.typekit.net/zok0skc.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/header.php') ?>

</head>

<style type="text/css">
    .sticky-top {
        z-index: 0;
    }
    #contents-aside {
        padding-top: 108px;
		width: 365px;
        margin: 0;
    }

    #contents-aside .nav {
        display:block;
    }

    .aside-category ul{
        padding: 10px 10px 23px;
        border: 15px solid #f5f5f5;
    }

    .aside-category ul li {
        margin: 8px 8px 15px;
    }

    .aside-category ul li a {
        color: #a2a9ad;
        font-family: 'Forza-Medium';
        font-size: 15px;
		line-height: 1.2;
		padding-bottom: 5px;
    }

    .aside-category ul li.active a {
        color: #427cbf;
		font-family: 'Forza-Medium':
    }
    .aside-category ul li.active a:before {
        background-color: #427cbf;
        content: "";
        pointer-events: none;
        left: -18px;
        width: 10px;
        height: 24px;
        position: absolute;
    }

    .article_section {
        margin-bottom: 40px;
    }

    .article_section h5 {
        color: #427cbf;
        font-family: 'Forza-Medium';
		padding-bottom: 10px;
    }
</style>
    
<div id="container" data-spy="scroll" data-target="#navbar-scrollspy">
        <div class="contents-visual contents-visual-article"
             style="background-image: url('/files/technical_articles/<?= $model->logo_file?>'); height: 385px; padding: 0">
        </div>
        <div id="contents" class="row" style="padding: 75px 0px 135px">
            <div class="article_view_wrapper col-md-8" >
                <div class="article-control">
                    <!--<a href="<?=$back != null ? '/resources/technical-articles/view/'.$back['slug'] : '#' ?>" class="article-back" style="border: 0px; box-shadow: none; color: #a2a9ad"><i class="far fa-angle-left"></i>&nbsp; Previous</a>-->
                    <span class="article_view_title" style="font-size: 32px; text-align: left; max-width: 100%; padding-right: 20px"><?= $model->title ?></span>
                    <!--<a href="<?=$forward != null ? '/resources/technical-articles/view/' .$forward['slug'] : '#' ?>" class="article-forward" style="border: 0px; box-shadow: none; color: #a2a9ad">Next &nbsp;<i class="far fa-angle-right"></i></a>-->
                </div>
                <div class="article_view_subtitle" style="text-align: left; max-width: 100%; font-family: 'Geogro-Medium'; font-size: 19px"><?= $model->subtitle ?></div>
				
                <div class="article_view_info" style="text-align: left">
                    <span></span>
                    <span class="article_date"><?=ucwords(strtolower($webhelper->GetMonthName($model->month))) ?> <?= $model->day ?>, <?= $model->year ?></span>
                </div>
				<br/>
                <div class="article_view_body">
                    <div id="article_section_1" class="article_section">
                        <h5><?= $model->section_1_title ?></h5>
                        <p style="font-size: 16px"><?= html_entity_decode($model->section_1_desc, ENT_QUOTES, "UTF-8") ?></p>
                        <?php if ($model->section_1_image !== "" && is_file($_SERVER['DOCUMENT_ROOT']."/files/technical_articles/".$model->section_1_image)) {
                            echo "<img src=\"/files/technical_articles/" . $model->section_1_image . "\" width=\"100%\">";
                        } ?>
                    </div>
                    <div id="article_section_2" class="article_section">
                        <h5><?= $model->section_2_title ?></h5>
                        <p style="font-size: 16px; margin-bottom: 10px"><?= html_entity_decode($model->section_2_desc, ENT_QUOTES, "UTF-8") ?></p>
                        <?php if ($model->section_2_image !== "" && is_file($_SERVER['DOCUMENT_ROOT']."/files/technical_articles/".$model->section_2_image)) {
                            echo "<img src=\"/files/technical_articles/" . $model->section_2_image . "\" width=\"100%\">";
                        } ?>
                    </div>
                    <div id="article_section_3" class="article_section">
                        <h5><?= $model->section_3_title ?></h5>
                        <p style="font-size: 16px"><?= html_entity_decode($model->section_3_desc, ENT_QUOTES, "UTF-8") ?></p>
                        <?php if ($model->section_3_image !== "" && is_file($_SERVER['DOCUMENT_ROOT']."/files/technical_articles/".$model->section_3_image)) {
                            echo "<img src=\"/files/technical_articles/" . $model->section_3_image . "\" width=\"100%\">";
                        } ?>
                    </div>
                    <div id="article_section_4" class="article_section">
                        <h5><?= $model->section_4_title ?></h5>
                        <p style="font-size: 16px"><?= html_entity_decode($model->section_4_desc, ENT_QUOTES, "UTF-8") ?></p>
                        <?php if ($model->section_4_image !== "" && is_file($_SERVER['DOCUMENT_ROOT']."/files/technical_articles/".$model->section_4_image)) {
                            echo "<img src=\"/files/technical_articles/" . $model->section_4_image . "\" width=\"100%\">";
                        } ?>
                    </div>
                    <div id="article_section_5" class="article_section">
                        <h5><?= $model->section_5_title ?></h5>
                        <p style="font-size: 16px"><?= html_entity_decode($model->section_5_desc, ENT_QUOTES, "UTF-8") ?></p>
                        <?php if ($model->section_5_image !== "" && is_file($_SERVER['DOCUMENT_ROOT']."/files/technical_articles/".$model->section_5_image)) {
                            echo "<img src=\"/files/technical_articles/" . $model->section_5_image . "\" width=\"100%\">";
                        } ?>
                    </div>
                </div>

                <div class="article_back">
                    <a href="/resources/technical-articles" class="article_back_link up_case">< back to technical articles</a>
                </div>
            </div>
            <div class="col-md-4">
                <aside id="contents-aside" class="sticky-top">
                    <div class="aside-category" id="navbar-scrollspy">
                        <ul class="nav nav-tabs" role="tablist">
                            <?php if ($model->section_1_title !== ""){ ?>
                            <li><a href="#article_section_1"><?= $model->section_1_title ?></a></li>
                            <?php } ?>
                            <?php if ($model->section_2_title !== ""){ ?>
                            <li><a href="#article_section_2"><?= $model->section_2_title ?></a></li>
                            <?php } ?>
                            <?php if ($model->section_3_title !== ""){ ?>
                            <li><a href="#article_section_3"><?= $model->section_3_title ?></a></li>
                            <?php } ?>
                            <?php if ($model->section_4_title !== ""){ ?>
                            <li><a href="#article_section_4"><?= $model->section_4_title ?></a></li>
                            <?php } ?>
                            <?php if ($model->section_5_title !== ""){ ?>
                            <li><a href="#article_section_5"><?= $model->section_5_title ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- //aside-category -->
                </aside>
            </div>
        </div>
    </div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap-scrollspy.js"></script>
<script>
    if (screen.width < 640) {
        $('.article_view_title').insertAfter($('.article-control').parent().find('.article-control'));
    }
    $('body').scrollspy({ target: '#navbar-scrollspy' });
    $('#navbar-scrollspy li a').on('click', function (e) {
        $('html,body').animate({
            scrollTop: $(e.target.hash).offset().top - 120
        });
    });
</script>


<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php') ?>