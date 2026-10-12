<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
extract($data, EXTR_OVERWRITE);
?><head>

        <title>core_lab: <?= $lab->title ?></title>
        <meta name="description" content="<?= $lab->sub_title ?>"/>
        <link rel='canonical'
              href='https://www.<?= $webhelper->Domain ?>/core_labs/view/<?= $lab->slug ?>'/>
        <meta charset="utf-8">
        <meta http-equiv = "content-language" content = "en">
        <meta property="og:title" content="<?= $lab->title ?>"/>
        <meta property="og:description" content="<?= $lab->sub_title ?>"/>
        <meta property="og:url" content='https://www.purigenbio.com/core_labs/view/<?= $lab->slug ?>'/>
        <link rel="stylesheet" href="/css/article.css?v=1.5">
        <link rel="stylesheet" href="https://use.typekit.net/zok0skc.css">

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/header.php') ?>

</head>

    
    
<div id="container">
        <div class="contents-visual contents-visual-article"
             style="background-image: url('/files/literature/<?= $lab->thumbnail2 ?>'); height: 385px; padding: 0">
            <!--<article>
                <p class="article_hero_title"><?= $lab->title ?></p>
                <p class="article_hero_info">
                    <span class="article_author"><?= $lab->contact_name ?></span>
                    <span class="article_separate"> | </span>
                    <span class="article_source"><?= $lab->organization ?></span>
                </p>
            </article>-->
        </div>
        <div id="contents">
            <div class="article_view_wrapper">
                <div class="article-control">
                    <a href="<?=$back != null ? '/resources/core-labs/view/'.$back['slug'] : '#' ?>" class="article-back" style="border: 0px; box-shadow: none; color: #a2a9ad"><i class="far fa-angle-left"></i>&nbsp; Previous</a>
                    <span class="article_view_title"><?= $lab->title ?></span>
                    <a href="<?=$forward != null ? '/resources/core-labs/view/' .$forward['slug'] : '#' ?>" class="article-forward" style="border: 0px; box-shadow: none; color: #a2a9ad">Next &nbsp;<i class="far fa-angle-right"></i></a>
                </div>
                <div class="article_view_subtitle"><?= $lab->sub_title ?></div>
                <div class="article_view_info">
                    <span></span>
                    <span class="article_author"><?= $lab->contact_name ?></span>
                    <span class="article_separate"> on </span>
                    <span class="article_date" style="text-transform: capitalize"><?=ucwords(strtolower($webhelper->GetMonthShortName($lab->month))) ?> <?= $lab->day ?>, <?= $lab->year ?></span>
                </div>
                <div class="article_view_body">
                    <?= $lab->body ?>
                </div>
                <div class="article_tags"><span style="font-family: 'Roboto-Bold'">Keywords: </span>
                    <?php foreach ($tags as $tag) { ?>
                        <span class="article_tag"><?= $tag ?></span>
                    <?php } ?>
                </div>
                <div class="article_back">
                    <a href="/resources/core-labs" class="article_back_link up_case">< back to core_labs</a>
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