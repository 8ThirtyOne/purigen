<!DOCTYPE html><head>

    <title>Pure DNA and RNA Extraction | Purigen Biosystems</title>

    <meta name="description" content="Purigen Biosystems is revolutionizing DNA extraction, isolation, and nucleic acid purification for life science researchers and scientists with its novel isotachophoresis technology." />

    <link rel="canonical" href="https://www.purigenbio.com/" />
    <meta content="A Revolution in DNA Extraction | Purigen Biosystems" property="og:title">
    <meta content="A Revolution in DNA Extraction | Purigen Biosystems" name="twitter:title">
    <meta content="The Purigen Ionic® Purification System is a new DNA extraction system that isolates pure, native, nucleic acid without the use of harsh lysis steps or chaotropic salts." property="og:description">
    <meta content="The Purigen Ionic® Purification System is a new DNA extraction system that isolates pure, native, nucleic acid without the use of harsh lysis steps or chaotropic salts." name="twitter:description">
    <meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" property="og:image">
    <meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" name="twitter:image">
    <meta content="website" property="og:type">
    <meta content="Purigen Biosystems | A Revolution in DNA Extraction" property="og:site_name">
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

    $sql = "select pkid, type, startyear, startmonth, startday, endyear, endmonth, endday, maintitle, subtitle, url, location1, location2, booth, thumbnail1, slug 
        from events where status = 1 and concat(endyear,LPAD(endmonth,2,0),LPAD(endday,2,0)) >= '$today' order by startyear asc, startmonth asc, startday asc limit 4";
    $EventList = $dbhelper->RunSQLReturnRows($sql);
    $dbhelper->dbClose();

    ?>

    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/header.php') ?>

</head>


<div id="container">

    <div class="main-visual" id="main-visual">
        <ul class="main-visual-slide" id="main-visual-slide">
            <!--<li class="active">
                <?php if(!$isMobile) { ?><video id="main-video1" playsinline autoplay muted="muted"><!--  loop> 
                    <source src="/media/vid/vid-hero-purigen-san-diego-v01a.mp4" type="video/mp4">
                </video><?php } ?>
                <article>
                    <h3>Come see the Ionic® Purification System</h3>
                    <h2>@ AACR 2020 - BOOTH 1248</h2>
                    <p>April 24 – 29 &nbsp; | &nbsp; San Diego, CA</p>
                    <a href="/news-events/event/aacr-2020"><i class="fas fa-chevron-circle-right fa-2x"></i> &nbsp; LEARN MORE</a>
                </article>
            </li>-->
            <li class="active">
                <?php if(!$isMobile) { ?><video id="main-video1" playsinline autoplay muted="muted"><!--  loop> -->
                    <source src="/videos/vid-purigen-purification-02-1080-18sec.mp4" type="video/mp4">
                </video><?php } ?>
                <article>
                    <h3>No beads, columns, or surface-binding</h3>
                    <h2>Simple Charge-based DNA / RNA Extraction</h2>
                    <p>Isotachophoresis separates and concentrates charged molecules in solution solely based on their electrophoretic mobility for pure DNA extraction.</p>
                    <a href="/technology/isotachophoresis.php"><i class="fas fa-chevron-circle-right fa-2x"></i> &nbsp; LEARN MORE</a>
                </article>
            </li>
            <li class="lazy-background">
                <?php if(!$isMobile) { ?><video id="main-video2" playsinline autoplay muted="muted"><!--  loop> -->
                    <source src="/media/vid/vid-hero-purigen-pop-v01b.mp4" type="video/mp4">
                </video><?php } ?>
                <article>
                    <h3>Proof-of-Performance (POP) Study</h3>
                    <h2>See the Purigen Ionic Advantage</h2>
                    <p>We invite you try Purigen and see the difference. Our POP program is available to any researcher wanting to compare their <a href="https://www.sciencelearn.org.nz/resources/2036-dna-extraction" target="_blank">traditional methods</a> / results to the Ionic Purification System.</p>
                    <a href="/support/request-info"><i class="fas fa-chevron-circle-right fa-2x"></i> &nbsp; REQUEST INFO</a>
                </article>
            </li>
            <li class="lazy-background">
                <?php if(!$isMobile) { ?><video id="main-video3" playsinline autoplay muted="muted"><!--  loop> -->
                    <source src="/media/vid/vid-hero-purigen-wp-itp-ffpe-v01j.mp4" type="video/mp4">
                </video><?php } ?>
                <article>
                    <h3><img class="lazy" data-src="https://www.purigenbio.com//images/common/icon-docs-blue.svg" width="48px" style="padding-right: 12px"> <span style="line-height: 1.9">White Paper</span></h3>
                    <h2>Isotachophoresis Improves<br>Nucleic Acid Extraction for FFPE</h2>
                    <p>Download our new white paper and learn how the Ionic system is transforming FFPE sample analysis.</p>
                    <a href="/resources/literature/register/isotachophoresis-improves-nucleic-acid-extraction-and-purification-from-ffpe-samples"><i class="fas fa-chevron-circle-right fa-2x"></i> &nbsp; DOWNLOAD TODAY</a>
                </article>
            </li>
            <li class="lazy-background">
                <?php if(!$isMobile) { ?><video id="main-video4" playsinline autoplay muted="muted"><!--  loop> -->
                    <source src="/videos/vid-purigen-ionic-dark-bg-test-01a.mp4" type="video/mp4">
                </video><?php } ?>
                <article>
                    <h3>Purigen Biosystems</h3>
                    <h2>Nucleic Acid Purification – Pure and Simple&trade;</h2>
                    <p>The Ionic<sup style="font-size: 12px">&reg;</sup> Purification System isolates pure, native nucleic acid without the use of harsh lysis steps or chaotropic salts.</p>
                    <a href="/products/ionic-system.php"><i class="fas fa-chevron-circle-right fa-2x"></i> &nbsp; LEARN MORE</a>
                </article>
            </li>
            <li class="lazy-background">
                <?php if(!$isMobile) { ?><video id="main-video5" playsinline muted="muted"><!--  loop> -->
                    <source src="/videos/vid-purigen-chips-hero-03h.mp4" type="video/mp4">
                </video><?php } ?>
                <article>
                    <h3>Purigen Ionic Kits</h3>
                    <h2>Simplify Your Purification Workflows</h2>
                    <p>Purigen protocols, fluidic chips, and reagents maximize nucleic acid yield and quality with fewer manual steps.</p>
                    <a href="/products/ionic-kits.php"><i class="fas fa-chevron-circle-right fa-2x"></i> &nbsp; LEARN MORE</a>
                </article>
            </li>
        </ul>
        <div class="main-visual-page-wrapper">
            <i id="prev-click" onClick="prev_next_click(this.id)" class="fal fa-3x fa-angle-left"></i>
            <div class="main-visual-page">
                <a href="#" class="active">slide 1</a>
                <a href="#">slide 2</a>
                <a href="#">slide 3</a>
                <a href="#">slide 4</a>
                <a href="#">slide 5</a>
            </div>
            <i id="next-click" onClick="prev_next_click(this.id)" class="fal fa-3x fa-angle-right"></i>
        </div>
    </div>
    <!-- //main-visual -->

    <div class="feature-bar" style="background-color: #15360f"><a href="https://purigen.co/3dNk7v9" target="_blank" style="color:#fff"><img class="lazy" data-src="images/svg/icon-purigen-white-square.svg" width="20" style="opacity:0.5; margin-right:10px">&nbsp; WEBINAR, WED AUGUST 19 @ 1:00 PM EST <span style="font-family:'Forza-Book'">&nbsp; - &nbsp; Get Pure RNA from FFPE with Half the Effort &nbsp; - &nbsp; <span style="font-family: 'Forza-Bold'"><i style="font-size: 20px" class="far fa-arrow-circle-right"></i>&nbsp; REGISTER TODAY!</span> &nbsp; &nbsp; <img class="lazy" data-src="images/svg/icon-purigen-white-square.svg" width="20" style="opacity:0.5; margin-right:10px"></a></div>

    <div class="main-product">
        <dl>
            <dt>Pure, Native Nucleic Acid</dt>
            <dd>Biological samples are gently lysed without the use of chaotropic salts. Nucleic acids are not dehydrated or denatured.</dd>
        </dl>
        <dl>
            <dt>Higher Amplifiable Yields</dt>
            <dd>Extract up to 50% more DNA from cultured cells and 3.5x or more from FFPE tissue samples versus traditional column-based methods.</dd>
        </dl>
        <dl>
            <dt>No Beads, Columns, or Surface-binding</dt>
            <dd><a href="https://microfluidics.stanford.edu/Projects/Current/DNA_RNA_ITP.html" target="_blank">Nucleic acids are purified solely based on electrophoretic mobility</a>. Elimination of binding, washing, and stripping reduces sample loss and contamination.</dd>
        </dl>
        <dl>
            <dt>No Risk Downstream</dt>
            <dd>Purification is not biased toward nucleic acids of a certain length or GC content.</dd>
        </dl>
        <dl>
            <dt>Superior Workflow for FFPE</dt>
            <dd>Purification of nucleic acids from FFPE scrolls or slides requires less than 3 minutes of hands-on time per sample (lysis included). No chemical deparaffinization is required.</dd>
        </dl>
        <dl>
            <dt>Automated Nucleic Acid Purification</dt>
            <dd>Nucleic acids are automatically separated and concentrated from sample lysate on the Purigen system in 60 minutes.</dd>
        </dl>
    </div>
    <!-- //main-product -->

    <div class="main-movie">
        <div class="main-movie-inner">
            <h2>See the Ionic Purification System in Action</h2>
            <p>
                The application of ITP to purify and quantify nucleic acids from complex biological samples was pioneered by <a href="https://profiles.stanford.edu/juan-santiago" target="_blank" style="color:#fff; font-family:'Roboto-Medium'">Purigen co-founder and Stanford University Professor, Juan G. Santiago</a>. The Ionic Purification System is compatible with a range of samples including cells and FFPE to help researchers, scientists, pathologists, and oncologists find the best method for DNA and RNA extraction.
            </p>
            <div class="main-movie-section">
                <div id="player" class="elementor-video-iframe" allowfullscreen="" src=""></div>
            </div>
        </div>
    </div>
    <!-- //main-movie -->

    <div class="main-event">

        <h2>Upcoming Events</h2>
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

                            <div class="event-date"><?=$webhelper->GetMonthShortName($row['startmonth'])?> <?=$row['startday']?> – <?=$row["endday"]?>, <?=$row["startyear"]?></div>

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
        <h2>PURIGEN FFPE Automated Workflow</h2>
        <p>Total hands-on time is ~24 minutes per 8 samples</p>
        <div class="main-workflow-inner">
            <img class="lazy" data-src="/images/technology/fig-ffpe-workflow-02b.svg" width="93%" alt="Purigen FFPE Workflow">
        </div>
        <i class="fas fa-chevron-left"></i>
        <i class="fas fa-chevron-right"></i>
        <div class="more-info"><a href="/products/ionic-ffpe"><img class="lazy" data-src="/images/common/icon-purigen-ffpe.svg" width="22" style="padding-top: 3px">&nbsp;&nbsp; MORE INFO</a></div>
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