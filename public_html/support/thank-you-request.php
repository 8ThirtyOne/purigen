<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

//Parameter
$pkid = $webhelper->RequestFilter('pkid', -1, false);

//check parameter
if($webhelper->isNull($pkid)) $webhelper->AlertMessage('Error. Please try again.');

$dbhelper->dbOpen();
$sql = "select firstname from request_information where pkid = $pkid";
$ViewData = $dbhelper->RunSQLReturnOneRow($sql);
$dbhelper->dbClose();
?>
<!DOCTYPE html><head>    
<title>Thank You | Purigen Biosystems</title>
<meta name="description" content="Thank you for contacting Purigen Biosystems." />
    
<!-- Event snippet for Purigen Web Form conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-718871573/dvb3COuSv7IBEJW45NYC'});
</script>
    
<!-- Event snippet for Purigen Web Form conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-718871573/dvb3COuSv7IBEJW45NYC'});
</script>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/header.php') ?>
</head>


<div id="container">
    <div class="contents-visual contents-visual-complete">
        <article class="title-type">
            <h2>Thank you, <?=$ViewData['firstname']?>.</h2>
            <p style="font-size:18px; padding-top:10px; line-height: 1.4">Thank you for your interest in Purigen.<br/>One of our representative will get back to you shortly.</p>
        </article>
    </div>
<br><br>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/view/featured_content/ionic-ffpe.php') ?>
<!-- //container -->
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php') ?>