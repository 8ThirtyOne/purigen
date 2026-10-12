<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$slug = $data['slug'];

//check parameter
if($webhelper->isNull($slug)) $webhelper->AlertMessageAndHistoryBack('Error. Please try again.');

$dbhelper->dbOpen();
$sql = "select pkid, slug, year, month, day, source, url, maintitle, subtitle, body, thumbnail, filename, orgfilename from media where status = 1 and slug = '$slug'";
$ViewData = $dbhelper->RunSQLReturnOneRow($sql);

if($webhelper->isNull($ViewData))
{
    $dbhelper->dbClose();
    $webhelper->AlertMessageAndHistoryBack("Error. Please try again.");
}

$sql = 'select slug from media where concat(year,month,day) < ' . $ViewData[year] . $ViewData[month] . $ViewData[day] . ' and type = ' . array_search('Press', Constants::ARTICLE_OR_PRESS) .'  order by year desc, month desc, day desc limit 1';
$forward = $dbhelper->RunSQLReturnOneRow($sql);

$sql = 'select slug from media where concat(year,month,day) > ' . $ViewData[year] . $ViewData[month] . $ViewData[day] . ' and type = ' . array_search('Press', Constants::ARTICLE_OR_PRESS) .'  order by year, month, day limit 1';
$back = $dbhelper->RunSQLReturnOneRow($sql);

// get last 10 press
$sqlAll = 'select pkid, year, month, day, source, maintitle, subtitle, type, slug from media where status = 1 and type = ' . array_search('Press', Constants::ARTICLE_OR_PRESS) . ' order by year desc, month desc, day desc  ';
$List = $dbhelper->RunSQLReturnRowsSub($sqlAll, 1, 10, $TotalCount);

$dbhelper->dbClose();
?>
    <!DOCTYPE html><head>

    <title><?=$ViewData["maintitle"]?></title>
    <meta name="description" content="<?=$ViewData["subtitle"]?>" />
    <link rel='canonical' href='https://www.<?=$webhelper->Domain?>/news-events/press/<?=$ViewData['slug']?>' />
    <meta charset="utf-8">
    <meta http-equiv = "content-language" content = "en">

    <link rel="stylesheet" href="/css/grid.css?v=1">

    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/header.php") ?>
    <style type="text/css">
        .icon-pdf {
            background-image: url(/images/common/icon-pdf-02.svg);
            width: 32px;
            height: 32px;
            display: inline-block;
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            vertical-align: middle;
        }

        .download-pdf {
            margin-top: -15px;
            margin-bottom: 15px;
        }
        .download-pdf a {
            color: red;
            font-weight: bold;
            line-height: 32px;
        }
        .press-right-blog{
            background-color: #f2f2f2;
            padding: 118px 20px 50px 20px;
        }
        .press-right-blog h3{
            text-transform:uppercase;
            font-size: 1.5em;
			font-family: 'Forza-Book';
            color: #3a7bc8;
            font-weight: 300;
        }
        .press-right-blog ul{
            border-top: 2px solid #FFFFFF;

        }
        .press-right-blog .press-info-block{
            margin: 30px 0px;
        }

        .press-right-blog .press-info-block .press-date{
            margin-bottom: 5px;
            font-size: 12px;
			font-family: 'Forza-Book';
            color: #555555;
        }
        .press-right-blog .press-info-block .press-title{
            font-size: 14px;
			font-family: 'Forza-Medium';
			line-height: 1;
            color: #54565a;
        }

        .press-right-blog .press-info-block .press-title:hover,
        .press-right-blog .press-info-block .press-title.active {
            color: #3a7bc8;
        }

    </style>
</head>

    <div id="container">
        <div id="contents" class="row none-visual">
            <div class="article-view col-md-8">
                <div class="article-control">
                    <a href="<?=$back != null ? "/news-events/press/".$back['slug'] : "#"?>" class="article-back"><i class="fas fa-chevron-left"></i> Newer</a>
                    <a href="<?=$forward != null ? "/news-events/press/".$forward['slug'] : "#"?>" class="article-forward">Older <i class="fas fa-chevron-right"></i></a>
                </div>
                <!-- //article-control -->
                <?php
                    $filepdf = "/files/media/".$ViewData['filename'];
                    if (is_file($_SERVER['DOCUMENT_ROOT'] . $filepdf)) {
                        ?>
                        <div class="download-pdf">
                            <a href="<?= $filepdf ?>" target="_blank"><i class="icon-pdf"></i> DOWNLOAD PDF</a>
                        </div>
                        <?php
                    }
                ?>
                <div class="article-util">
                    <div class="article-date"><?=$webhelper->GetMonthShortName($ViewData['month'])?> <?=$ViewData['day']?>, <?=$ViewData['year']?></div>
                    <dl>
                        <dt>SHARE:</dt>
                        <dd>
                            <a href="http://twitter.com/home?status=<?=$ViewData['maintitle']?> https://www.<?=$webhelper->Domain?>/news-events/press/<?=$ViewData['slug']?>" target="_blank"><i class="fab fa-twitter-square"></i></a>
                            <a href="http://linkedin.com/shareArticle?mini=true&url=https://www.<?=$webhelper->Domain?>/news-events/press/<?=$ViewData['slug']?>&title=<?=$ViewData['maintitle']?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                            <a href="http://www.facebook.com/sharer.php?s=100&p[url]=https://www.<?=$webhelper->Domain?>/news-events/press/<?=$ViewData['slug']?>&p[title]=<?= urlencode($ViewData['maintitle'])?>" target="_blank"><i class="fab fa-facebook-square"></i></a>
                        </dd>
                    </dl>
                </div>
                <!-- //article-util -->

                <div class="article-title">
                    <h2 style="font-family: 'Forza-Medium'; line-height: 1.4"><?=$ViewData["maintitle"]?></h2>
                    <h3><?=$ViewData["subtitle"]?></h3>
                </div>
                <!-- //article-title -->

                <article>
                    <?=$ViewData["body"]?>
                </article>

                <!-- //media-contact-->

            </div>
            <!-- //article-view -->
            <div class="col-md-4">
                <div class="press-right-blog">
                    <h3>Press releases</h3>
                    <ul>
                        <?php
                        if($List != null && count($List)>0)
                        {
                            foreach ($List as $row)
                            {
                                ?>
                                <li>
                                    <div class="press-info-block">
                                        <div class="press-date"><?=$webhelper->GetMonthShortName($row["month"])?> <?=$row["day"]?>, <?=$row["year"]?></div>
                                        <a href="/news-events/press/<?=$row['slug']?>" class="press-title<?= $slug===$row['slug']?' active':'' ?>">
                                            <?=$row["maintitle"]?>
                                        </a>
                                    </div>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>

                    <?=$webhelper->GetPageHtml($pageList, $page, "/news-events/press/list", $Parameter.'#a', $PageSize)?>
                </div>
            </div>

        </div>
        <!-- //contents -->
    </div>
    <!-- //container -->
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/footer.php") ?>