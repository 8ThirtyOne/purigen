<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
$regEvent = $data['regEvent'];
?>
<!DOCTYPE html><head>    
<title>Thank You | Purigen Biosystems</title>
<meta name="description" content="Thank you for contacting us at Purigen Biosystems." />

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/header.php") ?>
</head>


<div id="container">
    <div class="contents-visual contents-visual-complete" id="thank_page_event">
        <article class="title-type">
            <h2>Thank you, <?=$regEvent->firstname?>.</h2>
            <p style="font-size:18px; padding-top:10px; line-height: 1.4;">Thank you for registering! <br/>We look forward to meeting you at our event.</p>
        </article>
    </div>
    <!-- //contents-visual -->

    <!--<div id="contents">
        <div class="download-brochure">
            <p>Download the Purigen Ionic System brochure to learn more.</p>
            <div class="brochures brochures-center">
                <div class="brochures-thumb"><img src="/images/thumb/thmb-purigen-ionic-system-brochure-01b.jpg" alt="Purigen Ionic Purification System Brochure" width="276px" height="356px"/></div>
                <div class="brochures-title">Purigen Ionic&trade; Purification System</div>
                <div class="brochures-download"><a href="/media/pdf/BRH-Purigen-Ionic-System.pdf" class="button-big">download</a></div>
            </div>
        </div>
        <!-- //download-brochure -->
    </div>
    <!-- //contents -->
</div>
<!-- //container -->
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/footer.php") ?>