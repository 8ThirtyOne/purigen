<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

//Parameter
$page = $webhelper->RequestFilter('page', 0, false);
$type = $webhelper->RequestFilter('type', 0, false);

//check parameter
if ($webhelper->isNull($page)) $page = 1;
if ($webhelper->isNull($type)) $type = 0;


$Parameter = "&type=$type";

$PageSize = 6;

$dbhelper->dbOpen();
$sql = 'select * from video where status = 1';
if ($type != 0) {
    $sql .= " and type = '$type' ";
}
$sql .= ' order by title asc';
$List = $dbhelper->RunSQLReturnRowsSub($sql, $page, $PageSize, $TotalCount);
$pageList = $webhelper->getPaging($TotalCount, $page, $PageSize);
$dbhelper->dbClose();
$video_types = Constants::VIDEO_TYPES;
unset($video_types[null]);
array_splice($video_types, 0, 0, 'ALL');
?>
    <!DOCTYPE html><head>
        <title>Videos | Purigen Biosystems</title>
        <meta name="description" content="View and download the latest videos from Purigen Biosystems."/>
        <link rel="canonical" href="https://www.purigenbio.com/resources/videos"/>
        <meta content="Videos | Purigen Biosystems" property="og:title">
        <meta content="Videos | Purigen Biosystems" name="twitter:title">
        <meta content="View and download the latest videos from Purigen Biosystems." property="og:description">
        <meta content="View and download the latest videos from Purigen Biosystems." name="twitter:description">
        <meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" property="og:image">
        <meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" name="twitter:image">
        <meta content="website" property="og:type">
        <meta content="Purigen Biosystems | A Revolution in DNA Extraction" property="og:site_name">
        <meta content="summary" name="twitter:card">
        <meta content="@purigenbio" name="twitter:site">
        <meta content="1600" property="og:image:width">
        <meta content="400" property="og:image:height">

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/header.php') ?>

    </head>
    <script type="text/javascript">
        function goUrl(type) {
            location.href = "/resources/videos?type=" + type + "#a";
        }
    </script>

    
    <div id="container" class="videos_page">
        <!--<div class="contents-visual contents-visual-videos">
            <article>
                <h2>View our latest videos</h2>
                <p>Purigen Videos</p>
            </article>
        </div>-->


        <div class="contents-visual contents-visual contents-visual-videos<?php echo !$isMobile?" video-in-bg":""; ?>">
            <?php if(!$isMobile) { ?><video class="video-bg" playsinline autoplay muted="muted" loop="loop"><!--  loop> -->
                <source src="/videos/vid-purigen-purification-02c-1080-18sec.mp4" type="video/mp4">
            </video><?php } ?>
            <article class="title-type">
                <p>View our latest videos</p>
                <h3>Purigen Videos</h3>
				<a href="https://www.youtube.com/channel/UCpkZHg4ziC5rZzLKVImaFbQ" target="_blank"><i class="fab fa-youtube-square fa-lg"></i> &nbsp; SUBSCRIBE TO OUR YOUTUBE CHANNEL</a>
            </article>
        </div>

        <!-- //contents-visual -->
        <div id="contents" class="contents-flex">
            <aside id="contents-aside" class="contents-with-sticky">
                <div class="aside-category">
                    <h3>Categories</h3>
                    <ul>
                        <?php foreach ($video_types as $key => $video_type) { ?>
                            <li>
                                <div class="checkbox-set">
                                    <input type="radio" name="type"
                                           value="<?= $key ?>" <?= $webhelper->MakeSelectedValue($key, $type, 'checked') ?>
                                           onclick="goUrl('<?= $key ?>');"
                                           id="category-<?= $webhelper->slugify($video_type) ?>"/>
                                    <label for="category-<?= $webhelper->slugify($video_type) ?>"><?= $video_type ?></label>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- //aside-category -->
            </aside>

            <div id="contents-section">
                <a id="a" style="display:block;position:relative;top:-190px;visibility:hidden;"></a>
                <div class="contents-mobile-sorting">
                    <ul>
                        <?php foreach ($video_types as $key => $video_type) { ?>
                            <li class="<?= $webhelper->MakeSelectedValue($key, $type, 'active') ?>">
                                <a href="javascript:goUrl('<?= $key ?>');"><span><?= $video_type ?></span></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="contents-title">
                    <h2>Videos</h2>
                </div>

                <!-- //contents-title -->


                <div class="brochures-list">
                    <ul>
                        <?php
                        if ($List != null && count($List) > 0) {
                            foreach ($List as $row) { ?>
                                <li>
                                    <div class="brochures">
                                        <div class="brochures-type"><?= Constants::VIDEO_TYPES[$row['type']] ?></div>
                                        <div class="brochures-thumb"><img src="/files/video/<?= $row['thumbnail1'] ?>"
                                                                          alt="" width="276" height="356"/></div>
                                        <div class="brochures-meta">
                                            <span><?= $webhelper->GetMonthShortName($row['month']) ?> <?= $row['day'] ?> <?= $row['year'] ?></span>
                                        </div>
                                        <div class="brochures-title"><?= $row['title'] ?></div>
                                        <div class="brochures-desc"><?= $row['body'] ?></div>
                                        <div class="brochures-download">
                                            <?php if ($row['is_opened_registration'] == \models\Video::REGISTRATION_ENABLE) { ?>
                                                <a href="/resources/videos/register/<?= $row['slug'] ?>"
                                                   class="button-big">play
                                                    video</a>
                                            <?php } else { ?>
                                                <a href="/resources/videos/view/<?= $row['slug'] ?>"
                                                   class="button-big">play
                                                    video</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </li>
                            <?php }
                        } ?>
                    </ul>
                    <?= $webhelper->GetPageHtml($pageList, $page, '/resources/videos', $Parameter, $PageSize) ?>
                </div>
                <!-- //brochures-list -->
            </div>
            <!-- //contents-section -->
        </div>
        <!-- //contents -->
    </div>
    <!-- //container -->
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php') ?>