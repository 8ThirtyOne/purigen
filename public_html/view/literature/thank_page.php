<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
$regEvent = $data['regFromLiterature'];
$literature = $data['literature'];
$webhelper = new WebHelper();
?>
<!DOCTYPE html><head>    
<title>Thank You | Purigen Biosystems</title>
<meta name="description" content="Thank you for your interest in Purigen Biosystems." />

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/header.php") ?>
</head>


<div id="container" class="literature_thanks_page">
    <div class="contents-visual contents-visual-form-complete" id="thank_page_literature">
        <div id="thanks_block_wrapper">
            <div id="thanks_left_block">
                <article class="title-type">
                    <h2>Thank you, <?=$regEvent->firstname?>.</h2>
                    <p style="font-size:18px; padding-top:10px; line-height: 1.4;">Thank you for your interest in Purigen and registering for this content. Please proceed with download.</p>
                    <a href="/include/download_literature.php?pkid=<?= $literature->pkid ?>" class="button-big">download</a>
                </article>
            </div>
            <div id="thanks_right_block">
                <div class="download-brochure">
                    <div class="brochures brochures-center">
                        <div class="brochures-thumb"><img src="/files/literature/<?= $literature->thumbnail2 ?>" alt="<?= $literature->title ?>" width="276px" height="356px"/></div>
                        <div class="brochures-meta">
                            <span><?= $webhelper->GetFileType($literature->orgfilename) ?></span>
                            <span><?= $webhelper->GetFileSize('/literature/' . $literature->filename) ?></span>
                        </div>
                        <div class="pdf_info">
                            <!--<span class="pdf_type"><?= Constants::LITERATURE_TYPES[$literature->type] ?></span>:--><span class="brochures-title" style="font-family: 'Forza-Medium'"><?= $literature->title ?></span>
                        </div>
                        <div class="brochures-download"><a href="/include/download_literature.php?pkid=<?= $literature->pkid ?>" class="button-big">download</a></div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //contents-visual -->
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/footer.php") ?>