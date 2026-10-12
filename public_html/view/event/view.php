<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();

$title = $data['slug'];
try {
    if (!$title) {
        throw new Exception('Event does not exist');
    }
    $event = (object)models\Events::find('first', ['conditions' => ["slug = '$title'"]]);
    if (empty((array)$event)){
        throw new Exception('Event does not exist');
    }
} catch (Exception $e) {
    $webhelper->AlertMessageAndHistoryBack($e->getMessage());
}
?>
<!DOCTYPE html><head>

    <title>Purigen at <?= $event->maintitle ?></title>
    <meta name="description" content="<?= $event->description ?>"/>
    <meta content="Visit or join Purigen at this event to learn more about the pure DNA and RNA extraction." property="og:description">
    <link rel='canonical'
          href='https://www.<?= $webhelper->Domain ?>/news-events/event/<?= $event->slug ?>'/>
    <meta charset="utf-8">

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/header.php") ?>

    </head>

    <div id="container">
        <div id="contents" class="event_page">
            <div id="hero_wrapper" style="background-image: url('/files/events/<?= $event->thumbnail2 ?>')">
                <div id="hero_content">

                    <p id="join_us">
                        <span class="up_case font_bigger">Join Us</span>
                    </p>
                    <p id="start_end">
                        <span><?=$webhelper->GetMonthShortName($event->startmonth)?> <?=$event->startday?> – <?=$webhelper->GetMonthShortName($event->endmonth)?> <?= $event->endday?>, <?= $event->startyear?></span>
                    </p>
                    <h1 id="event_title" class="font_bigger"><?= $event->maintitle ?></h1>
                    <p id="event_booth" class="up_case font_bigger">
                        <?php $booth = explode(' ', $event->booth, 2);?>
                        <span class="booth_title"><?= $booth[0] ?></span>
                        <span class="booth_value"><?= $booth[1] ?></span>
                    </p>
                    <p id="event_location1" class="font_big"><?= $event->location1 ?></p>
                    <p id="view_map" class="event_button">
                        <a href="<?= $event->more_info_url ?>" target="_blank" class="up_case event_button_info" id="more_info_link"><?= !empty($event->ctabutton1)?$event->ctabutton1:"More info" ?></a>

                    </p>
                </div>
            </div>
            <div id="event_content">
                <p id="event_description"><?= $event->description ?></p>
                <?php if (!empty($event->map_url)) {?>
                <p id="more_info" class="event_button">
                    <a href="<?= $event->map_url ?>" target="_blank" class="up_case event_button_link" id="view_map_link"><?= !empty($event->ctabutton2)?$event->ctabutton2:"More info" ?></a>
                </p>
                <?php } ?>
                <!--<p id="purigen_events">Purigen Event(s)</p>-->
                <!--<p id="event_type"><?=strtoupper($webhelper->GetEventCategory($event->type))?></p>-->
                <div id="add_info">
                    <?= $event->add_info ?>
                </div>
                <?php if ($event->is_opened_registration) { ?>
                <p id="register_today" class="event_button">
                    <a href="/news-events/event/register/<?= $title ?>" class="up_case event_button_link" id="register_today_link">register for this event</a>
                </p>
                <?php } ?>
            </div>
        </div>
    </div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/footer.php") ?>