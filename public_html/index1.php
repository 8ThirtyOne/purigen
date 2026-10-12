<!DOCTYPE html><head>

    <title>Pure DNA and RNA Extraction | Purigen Biosystems</title>

    <meta name="description" content="Purigen Biosystems is revolutionizing automated extraction, isolation, and purification of DNA and RNA from FFPE and cells for cancer and oncoloy research with its novel isotachophoresis charge-based extraction technology." />

    <link rel="canonical" href="https://www.purigenbio.com/" />
    <meta content="Pure DNA and RNA Extraction | Purigen Biosystems" property="og:title">
    <meta content="Pure DNA and RNA Extraction | Purigen Biosystems" name="twitter:title">
    <meta content="The Purigen Ionic® Purification System is a new charge-based DNA and RNA extraction system that isolates pure, native, nucleic acid freely in solution, with no binding or stripping from surfaces." property="og:description">
    <meta content="The Purigen Ionic® Purification System is a new charge-based DNA and RNA extraction system that isolates pure, native, nucleic acid freely in solution, with no binding or stripping from surfaces." name="twitter:description">
    <meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" property="og:image">
    <meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" name="twitter:image">
    <meta content="website" property="og:type">
    <meta content="Purigen Biosystems | Pure DNA and RNA Extraction" property="og:site_name">
    <meta content="summary" name="twitter:card">
    <meta content="@purigenbio" name="twitter:site">
    <meta content="1600" property="og:image:width">
    <meta content="400" property="og:image:height">

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

    $webhelper = new WebHelper();
    $dbhelper = new dbHelper();

    $today = date('Ymd');

    $dbhelper->dbOpen();

    $sql = 'select * from media where status = 1 order by year desc, month desc, day desc limit 5 ';

    $NewsList = $dbhelper->RunSQLReturnRows($sql);

    $sql = "select pkid, type, startyear, startmonth, startday, endyear, endmonth, endday, maintitle, subtitle, url, location1, location2, ctabutton1, ctabutton2, booth, thumbnail1, slug 
        from events where status = 1 and concat(endyear,LPAD(endmonth,2,0),LPAD(endday,2,0)) >= '$today' order by startyear asc, startmonth asc, startday asc limit 4";
    $EventList = $dbhelper->RunSQLReturnRows($sql);
    $dbhelper->dbClose();

    ?>

    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/header.php') ?>

</head>


<div id="container">

    <div class="main-visual" id="main-visual">
        <ul class="main-visual-slide" id="main-visual-slide">

			<li class="active">
                <?php if(!$isMobile) { ?><video id="main-video1" playsinline autoplay muted="muted"><!--  loop> -->
                    <source src="/videos/hero-ionic-system-02t.mp4" type="video/mp4">
                </video><?php } ?>
                <article>
                    <h3 style="color: #6E6E6E">Ionic&reg; Purification System - Charge-based DNA / RNA Extraction</h3>
                    <h1 style="color: #000000">The Next-Gen Sample Prep System</h1>
                    <p style="color: #6E6E6E">The revolutionary Ionic system requires no binding, stripping, or washing from fixed surfaces for higher yields, higher quality, and better data for your research.</p>
                    <a href="https://www.purigenbio.com/products/ionic-system" style="color: #427CBF"><i class="fas fa-chevron-circle-right fa-2x"></i> &nbsp; LEARN MORE</a>
                </article>
            </li>
			
			<li class="lazy-background">
                <?php if(!$isMobile) { ?><video id="main-video2" playsinline autoplay muted="muted"><!--  loop> -->
                    <source src="/videos/hero-virus-04e.mp4" type="video/mp4">
                </video><?php } ?>
                <article>
                    <h3>NEW: Early Access - Ionic&reg; Pure Viral RNA</h3>
                    <h1>Automated Extraction of High-quality Viral RNA</h1>
                    <p>Overcome the challenges of getting insufficient viral RNA yields with a simple, automated, charge-based extraction method for Covid and other virus research.</p>
                    <a href="/applications/ionic-pure-viral-rna"><i class="fas fa-chevron-circle-right fa-2x"></i> &nbsp; LEARN MORE</a>
                </article>
            </li>
			
			<li class="lazy-background">
                <?php if(!$isMobile) { ?><video id="main-video3" playsinline autoplay muted="muted"><!--  loop> -->
                    <source src="/videos/vid-purigen-purification-02c-1080-18sec.mp4" type="video/mp4">
                </video><?php } ?>
                <article>
                    <h3>No beads, no columns, no surface-binding</h3>
                    <h1>Simple, Automated, Charge-based DNA and RNA Extraction</h1>
                    <p>Isotachophoresis separates and concentrates charged molecules in solution solely based on their electrophoretic mobility for pure DNA and RNA extraction.</p>
                    <a href="/technology/isotachophoresis.php"><i class="fas fa-chevron-circle-right fa-2x"></i> &nbsp; LEARN MORE</a>
                </article>
            </li>

        </ul>
        <div class="main-visual-page-wrapper">
            <i id="prev-click" onClick="prev_next_click(this.id)" class="fal fa-3x fa-angle-left"></i>
            <div class="main-visual-page">
                <a href="#" class="active">slide 1</a>
                <a href="#">slide 2</a>
				<a href="#">slide 3</a>
            </div>
            <i id="next-click" onClick="prev_next_click(this.id)" class="fal fa-3x fa-angle-right"></i>
        </div>
    </div>
    <!-- //main-visual -->
	
	<!-- pop program -->
		<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/pop-program.php') ?>
	<!--//pop program -->

    <div class="main-product">
        <dl>
            <dt>Pure, Native, Intact DNA, RNA and miRNA</dt>
            <dd>Biological samples are gently lysed without the use of chaotropic salts. Nucleic acids are not denatured or dehydrated.</dd>
        </dl>
        <dl>
            <dt>Higher Amplifiable Yields and Better Data</dt>
            <dd>Extract up to 50% more DNA from cultured cells, and 3.5x more DNA and 2x more RNA from FFPE samples versus traditional column-based methods.</dd>
        </dl>
        <dl>
            <dt>No Beads, No Columns,<br>No Surface-binding</dt>
            <dd><a href="https://microfluidics.stanford.edu/Projects/Current/DNA_RNA_ITP.html" target="_blank">Nucleic acids are purified solely based on electrophoretic mobility</a>. Elimination of binding, washing, and stripping reduces sample loss and contamination.</dd>
        </dl>
        <dl>
            <dt>No Risk Downstream</dt>
            <dd>Purification is not biased toward nucleic acids of a certain length or GC content.</dd>
        </dl>
        <dl>
            <dt>Superior Workflow for FFPE</dt>
            <dd>Extraction of RNA, DNA, and miRNA from FFPE scrolls or slides requires less than<br>3 minutes of hands-on time per sample (lysis included). No chemical deparaffinization is required.</dd>
        </dl>
        <dl>
            <dt>Automated Nucleic Acid Purification</dt>
            <dd>Nucleic acids are automatically separated and concentrated from sample lysate on the Ionic Purification System in<br>~60 minutes.</dd>
        </dl>
    </div>
    <!-- //main-product -->

	<!-- featured video -->
		<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/video.php') ?>
	<!--//featured video -->

    <div class="main-movie">
        <div class="main-movie-inner">
            <h2>See the Ionic Purification System in Action</h2>
            <p>
                The application of ITP to purify and quantify nucleic acids from complex biological samples was pioneered by <a href="https://profiles.stanford.edu/juan-santiago" target="_blank" style="color:#fff; font-family:'Roboto-Medium'">Purigen co-founder and Stanford University Professor, Juan G. Santiago</a>. The Ionic Purification System is compatible with a range of samples including cells and FFPE to help researchers, scientists, pathologists, and oncologists find the best method for DNA and RNA extraction.
            </p>
            <div class="main-movie-section">
                <div id="player" class="elementor-video-iframe" allowfullscreen="" src="" data-src="https://www.youtube.com/embed/C9v9O0egC54?feature=oembed&amp;start&amp;end&amp;wmode=opaque&amp;loop=0&amp;controls=1&amp;mute=0&amp;rel=0&amp;modestbranding=0"></div>
            </div>
        </div>
    </div>
    <!-- //main-movie -->

    <div class="main-event">

        <h2>Purigen Events</h2>
        <ul>
            <?php
            if($EventList !== null && count($EventList)>0)
            {
                foreach ($EventList as $row)
                {
                    ?>
                    <li>
                        <a href="/news-events/event/<?=$row['slug']?>">

                            <div class="event-thumb"><img class="lazy" data-src="/files/events/<?=$row['thumbnail1']?>" width="150" height="90" alt="Purigen Events" style="border: solid 3px #efefef"/></div>

                            <div class="event-date"><?=$webhelper->GetMonthShortName($row['startmonth'])?> <?=$row['startday']?> – <?=$webhelper->GetMonthShortName($row['endmonth'])?> <?=$row["endday"]?>, <?=$row["startyear"]?></div>

                            <div class="event-title"><?=$row['maintitle']?></div>
                            <div class="event-location"><?=$row['location1']?></div>
                            <div class="event-section"><?=$row['booth']?></div>
                        </a>
                    </li>

                    <?php
                }
            }
            ?>
        </ul>

        <div class="view-all"><a href="/news-events/events/list.php"><i class="fas fa-th-large"></i> &nbsp; VIEW ALL</a></div>

    </div>
    <!-- //main-event -->

	<!-- purigen newsletter -->
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/news.php') ?>
    <!--//purigen newsletter -->

    <div class="main-news">
        <h2>Latest News <br/> and Updates</h2>
        <dl>
            <dt id="main-news-type"></dt>
            <dd id="main-news-date"></dd>
        </dl>
        <article>
            <p id="main-news-maintitle"></p>
        </article>

        <div class="main-news-more">
            <a href="javascript:void(0);" onclick="mainNewsPrev()" class="narrow_news narrow-left"><i class="fas fa-chevron-left"></i></a>
            <a id="main-news-pkid" href="/news-events/news/view.php?pkid=<?=$row['pkid']?>">READ MORE</a>
            <a href="javascript:void(0);" onclick="mainNewsNext()" id="mainNewsNext" class="narrow_news narrow-right"><i class="fas fa-chevron-right"></i></a>
        </div>

        <?php
        if($NewsList != null && count($NewsList)>0)
        {
            foreach ($NewsList as $row)
            {
                $month[] = $webhelper->GetMonthShortName($row['month']);
                $day[] = $row['day'];
                $year[] = $row['year'];
                $maintitle[] = $row['maintitle'];
                $pkid[] = $row['pkid'];
                $type[] = Constants::ARTICLE_OR_PRESS[$row['type']];
            }
        }
        ?>

        <script type="text/javascript">
            var monthArray = <?php echo json_encode($month); ?>;
            var dayArray = <?php echo json_encode($day); ?>;
            var yearArray = <?php echo json_encode($year); ?>;
            var maintitleArray = <?php echo json_encode($maintitle); ?>;
            var pkidArray = <?php echo json_encode($pkid); ?>;
            var typeArray = <?php echo json_encode($type); ?>;
            var idx = 0;

            mainNewsDisplay();

            var newsTimer = setInterval(autoClick, 5000);

            function autoClick()
            {
                $("#mainNewsNext").click();
            }

            function mainNewsPrev() {
                clearInterval(newsTimer);newsTimer = setInterval(autoClick, 5000);
                idx--;mainNewsDisplay();return false;
            }

            function mainNewsNext() {
                clearInterval(newsTimer);newsTimer = setInterval(autoClick, 5000);
                idx++;mainNewsDisplay();return false;
            }
            function mainNewsDisplay() {
                if (maintitleArray.length != 0) {
                    if (idx < 0) {
                        idx = maintitleArray.length - 1;
                    } else if (maintitleArray.length == idx || maintitleArray.length < idx) {
                        idx = 0;
                    }

                    var newsDate = monthArray[idx] + " " + dayArray[idx] + ", " + yearArray[idx];
                    var newsId = "/news-events/news/view.php?pkid=" + pkidArray[idx];

                    document.getElementById("main-news-type").textContent=typeArray[idx];
                    document.getElementById("main-news-date").textContent=newsDate;
                    document.getElementById("main-news-maintitle").textContent=maintitleArray[idx];
                    document.getElementById("main-news-pkid").href=newsId;
                }
            }
        </script>

        <!--<div class="view-all"><a href="/news-events/news/list.php"><i class="fas fa-th-large"></i> &nbsp; VIEW ALL</a></div>-->
    </div>
    <!-- //main-news -->

    <div class="main-workflow">
        <h2>Purigen's FFPE to Pure DNA and RNA Automated Workflow</h2>
        <p>Total hands-on time is ~24 minutes per 8 samples</p>
        <div class="main-workflow-inner">
            <img class="lazy" data-src="/images/svg/fig-ffpe-workflow-03b.svg" width="88%" alt="Purigen FFPE Workflow">
        </div>
        <i class="fas fa-chevron-left"></i>
        <i class="fas fa-chevron-right"></i>
        <div class="more-info"><a href="/applications/ionic-ffpe-pure-dna"><img class="lazy" data-src="/images/common/icon-purigen-ffpe.svg" width="22" style="padding-top: 3px">&nbsp;&nbsp; MORE INFO</a></div>
    </div>
    <!-- //main-workflow -->

</div>

<!-- //container -->
<script>
    function prev_next_click(clicked_id) {
        if (clicked_id == "next-click") {
            if ($('.active').next().length == 2) {
                $('.active').next().click();
            } else {
                $('.main-visual-page a')[0].click();
            }
        } else if (clicked_id == "prev-click") {
            if ($('.active').prev().length == 0) {
                $('.main-visual-page a')[3].click();
            } else {
                $('.active').prev().click();
            }
        }
    };
</script>
<script defer>
    if(navigator.userAgent.indexOf("Chrome-Lighthouse") == -1) {
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player;

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '315',
                width: '560',
                videoId: 'C9v9O0egC54',
            });
        }
    }
</script>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php') ?>