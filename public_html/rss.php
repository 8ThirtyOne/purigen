<?php
header('Content-type: application/xml; charset=utf-8');
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
$press = models\Media::find('all', ['conditions' => 'type = 1', 'order' => 'year desc, month desc, day desc']);
echo <<<HTML
<?xml-stylesheet href='/css/rss.css?v=1.0' type='text/css'?>
HTML;
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>Purigen Press Releases</title>
        <link>https://www.purigenbio.com</link>
        <description>Press Releases</description>
        <language>en-us</language>
        <atom:link rel="self" type="application/rss+xml" href="https://www.purigenbio.com/rss" />
        <?php foreach ($press as $item) { ?>
        <item>
            <?php $d = new DateTime( "$item->year-$item->month-$item->day" ) ?>
            <title><?php echo $item->maintitle ?></title>
            <pubDate><?php echo $d->format('r')?></pubDate>
            <description><?php echo str_replace('&', 'and', strip_tags($item->body)) ?></description>
            <guid isPermaLink="true">https://www.purigenbio.com/news-events/press/view.php?pkid=<?php echo $item->pkid ?></guid>
        </item>
        <?php } ?>
    </channel>
</rss>
