<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
$regFromVideo = $data['regFromVideo'];
$video = \models\Video::find($regFromVideo['video_id']);
$webhelper = new WebHelper();
?>
    <!DOCTYPE html><head>
    <title>Thank You | Purigen Biosystems</title>
    <meta name="description" content="Thank you for contacting us at Purigen Biosystems." />

    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/header.php") ?>
</head>


    <div id="container" class="literature_thanks_page">
        <div class="contents-visual contents-visual-form-complete" id="thank_page_literature">
            <div id="thanks_block_wrapper">
                <div id="thanks_left_block">
                    <article class="title-type">
                        <h2>Thank you, <?=$regFromVideo['firstname']?>.</h2>
                        <p style="font-size:18px; padding-top:10px; line-height: 1.4;">Thank you for your interest in Purigen and registering for this content.</p>
                        <a href="/resources/videos/view/<?= $video->slug ?>" class="button-big">play video</a>
                    </article>
                </div>
                <div id="thanks_right_block">
                    <div class="download-brochure">
                        <div class="brochures brochures-center">
                            <div class="brochures-thumb"><img src="/files/video/<?= $video->thumbnail2 ?>" alt="<?= $video->title ?>" width="276px" height="356px"/></div>
                            <div class="brochures-download"><a href="/resources/videos/view/<?= $video->slug ?>" class="button-big">play video</a></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- //contents-visual -->
    </div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/footer.php") ?>