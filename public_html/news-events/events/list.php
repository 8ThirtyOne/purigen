<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

//Parameter
$page = $webhelper->RequestFilter("page", 0, false);

//check parameter
if($webhelper->isNull($page)) $page = 1;

$PageSize = 4;
$today = date('Ymd');

$dbhelper->dbOpen();
$sql = "select * from events where status = 1 and concat(endyear,LPAD(endmonth,2,0),LPAD(endday,2,0)) >= '$today' order by startyear asc, startmonth asc, startday asc ";
$List = $dbhelper->RunSQLReturnRowsSub($sql, $page, $PageSize, $TotalCount);
$pageList = $webhelper->getPaging($TotalCount, $page, $PageSize);
$dbhelper->dbClose();
?>
<!DOCTYPE html><head>    
<title>Events | Purigen Biosystems</title>
<meta name="description" content="Join us for our upcoming events - Purigen Biosystems is transforming DNA, RNA, and miRNA extraction and nucleic acid purification." />
<link rel="canonical" href="https://www.purigenbio.com/news-events/events/list" />
<meta content="Events | Purigen Biosystems" property="og:title">
<meta content="Events | Purigen Biosystems" name="twitter:title">
<meta content="Join us for our upcoming events - Purigen Biosystems is revolutionizing DNA extraction and nucleic acid purification." property="og:description">
<meta content="Join us for our upcoming events - Purigen Biosystems is revolutionizing DNA extraction and nucleic acid purification." name="twitter:description">
<meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" property="og:image">
<meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" name="twitter:image">
<meta content="website" property="og:type">
<meta content="Purigen Biosystems | A Revolution in DNA Extraction" property="og:site_name">
<meta content="summary" name="twitter:card">
<meta content="@purigenbio" name="twitter:site">
<meta content="1600" property="og:image:width">
<meta content="400" property="og:image:height">

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/header.php") ?>
</head>

<div id="container" style="overflow-x: hidden;">
    <div class="contents-visual contents-visual-events">
        <article>
            <h2>Visit us at our upcoming events</h2>
            <p>Purigen Events</p>
        </article>
        <div class="featured-event">
            <h2>Featured Event</h2>
            <h3>Cell-NCI Symposium: Beyond Cancer Genomics</h3>
            <div class="featured-event-booth"><a href="http://www.cell-symposia.com/cancer-genomics-2021/default.asp" target="_blank" style="color: #FFFFFF">ONLINE</a></div>
            <div class="featured-event-location">VIRTUAL</div>
            <div class="featured-event-date">October 4-6, 2021</div>
            <div class="featured-event-view"><a href="http://www.cell-symposia.com/cancer-genomics-2021/default.asp" target="_blank">REGISTER</a></div>
        </div>
    </div>
    <!-- //contents-visual -->
	
	<!-- purigen newsletter -->
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/news.php') ?>
    <!--//purigen newsletter -->

    <div id="contents" class="contents-pd0">
        <div class="contents-title">
            <a id="a" style="display:block;position:relative;top:-140px;visibility:hidden;"></a>
            <div class="contents-tab">
                <ul>
                    <li class="active"><a href="/news-events/events/list.php#a">upcoming</a></li>
                    <li><a href="/news-events/events/past-list.php#a">past</a></li>
                </ul>
            </div>
            <h2>Upcoming Events</h2>
        </div>
        <!-- //contents-title -->

        <div class="upcoming-event">
            <ul>
            <?php
                if($List != null && count($List)>0)
                {
                    foreach ($List as $row)
                    {
            ?>
                <li>
                    <div class="upcoming-event-contents">
                        <div class="upcoming-event-date"><?=$webhelper->GetMonthShortName($row["startmonth"])?> <?=$row["startday"]?> – <?=$webhelper->GetMonthShortName($row["endmonth"])?> <?=$row["endday"]?>, <?=$row["endyear"]?></div>
                        <div class="upcoming-event-container">
                            <div class="upcoming-event-type"><?=strtoupper($webhelper->GetEventCategory($row["type"]))?></div>
                            <div class="upcoming-event-thumb"><img src="/files/events/<?=$row["thumbnail1"]?>" alt="" width="200" height="120" style="border: solid 3px #cccccc"/></div>
                            <div class="upcoming-event-contact">
                                <div class="upcoming-event-location"><?=$row["location1"]?></div>
                                <div class="upcoming-event-title"><?=$row["maintitle"]?></div>
                                <div class="upcoming-event-booth"><?=$row["booth"]?></div>
                                <div class="upcoming-event-location"><?=$row["location2"]?></div>
                                <div class="upcoming-event-desc"><?=$row["description"]?></div>
                            </div>
                        </div>
                        <div class="upcoming-event-view"><a href="/news-events/event/<?=$row["slug"]?>" class="button-big"><strong>LEARN MORE</strong> </a></div>
                    </div>
                </li>
            <?php
                    }
                }
            ?>
            </ul>
            
            <?=$webhelper->GetPageHtml($pageList, $page, "/news-events/events/list.php", $Parameter.'#a', $PageSize)?>
        </div>
        <!-- //events -->
    </div>
    <!-- //contents -->
</div>
<!-- //container -->
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/footer.php") ?>