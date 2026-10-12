<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();

$title = $data['slug'];
try {
    if (!$title) {
        throw new Exception('Event does not exist');
    }
    $event = (object)models\Events::find('first', ['conditions' => ["slug = '$title'"]]);
    if (empty((array)$event)) {
        throw new Exception('Event does not exist');
    }
} catch (Exception $e) {
    $webhelper->AlertMessageAndHistoryBack($e->getMessage());
}
?>
<!DOCTYPE html><head>

    <title>RSVP: <?= $event->maintitle ?></title>
    <meta name="description" content="<?= $event->description ?>"/>
    <meta content="Join us for this special event sponsored by Purigen Biosystems." property="og:description">
    <link rel='canonical'
          href='https://www.<?= $webhelper->Domain ?>/news-events/event/register/<?= $event->slug ?>'/>
    <meta charset="utf-8">

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/header.php") ?>

    </head>

    
    <div id="container" style="background-color: #f9f9f9">

        <div id="contents" class="none-visual">
            <div class="contents-title" id="event_register_wrapper">
                <p class="up_case event_register">register for</p>
                <?php /*
                <h2 id="register_event_title">Event @ <?= $event->maintitle ?></h2>
                <?php
                $date = new DateTime("$event->startyear-$event->startmonth-$event->startday");
                $dayName = date('l', strtotime($date));
                $monthName = date('F', strtotime($date));
                ?>
                <p id="register_event_date"><?php echo $dayName . ', ' . $monthName . ' ' . $event->startday; ?></p>
                <?php */ ?>
                <div id="event_registration_header">
                    <?php echo $event->registration_header ?>
                </div>
            </div>

            <!-- //contents-title -->

            <form name="requestFrm" method="post" action="/news-events/event/save">
                <div class="form">
                    <div class="form-required">* Required</div>
                    <input type="hidden" name="event_id" value="<?= $event->pkid; ?>"/>
                    <input type="hidden" id="grecaptchaval" name="grecaptchaval" />
                    <div class="form-row">
                        <dl>
                            <dt><label for="">FIRST NAME*</label></dt>
                            <dd><input type="text" name="firstname" id="firstname" maxlength="20"/></dd>
                        </dl>
                        <dl>
                            <dt><label for="">LAST NAME*</label></dt>
                            <dd><input type="text" name="lastname" id="lastname" maxlength="20"/></dd>
                        </dl>
                    </div>
                    <div class="form-row">
                        <dl>
                            <dt><label for="">WORK EMAIL*</label></dt>
                            <dd><input type="email" name="email" id="email" maxlength="60" required/></dd>
                        </dl>
                        <dl>
                            <dt><label for="">PHONE</label></dt>
                            <dd><input type="text" name="phone" id="phone" maxlength="50"/></dd>
                        </dl>
                    </div>
                    <div class="form-row">
                        <dl>
                            <dt><label for="">ORGANIZATION / INSTITUTION*</label></dt>
                            <dd><input type="text" name="organization" id="organization" maxlength="100"/></dd>
                        </dl>
                        <dl>
                            <dt><label for="">JOB TITLE</label></dt>
                            <dd><input type="text" name="job_title" id="job_title" maxlength="100"/></dd>
                        </dl>
                    </div>
                    <div class="form-row">
                        <dl>
                            <dt><label for="">STATE / PROVINCE*</label></dt>
                            <dd><input type="text" name="state" id="state" maxlength="50"/></dd>
                        </dl>
                        <dl>
                            <dt><label for="">ZIP</label></dt>
                            <dd><input type="text" name="country" id="country" maxlength="20"/></dd>
                        </dl>
                    </div>
                    <div class="form-row">
                        <dl>
                            <dt><label for="">MAIN APPLICATION / RESEARCH</label></dt>
                            <dd><input type="text" name="main_application" id="main_application" maxlength="100"/></dd>
                        </dl>
                    </div>
                    <div class="form-agree">
                        <div class="checkbox-set"><input type="checkbox" name="isreceive" value="1"
                                                         id="category-brochures"/> <label for="category-brochures">YES,
                                I'd like to receive the latest news about Purigen.</label></div>
                    </div>
                    <div class="form-row">
                        <dl>
                            <dt><label for="">Would you like one of our reps to follow-up? &nbsp; &nbsp; &nbsp;  - ADD COMMENTS OR QUESTIONS -</label></dt>
                            <dd><textarea name="note" id="note"></textarea></dd>
                        </dl>
                    </div>
                    <div class="form-info">By submitting, you are agreeing to our <a href="/company/privacy.php">Privacy
                            Policy</a>.</strong></div>
                    <div class="form-submit">
                        <button type="button" onclick="checkFrm();">REGISTER</button>
                    </div>
                </div>
            </form>
            <!-- //form -->
        </div>
        <!-- //contents -->
    </div>

    <!-- //container -->

    <div id="error-msg" style="display: none" class="pop_wrap">
        <div>
            <div>
                <div class="pop_data">
                    <h2 style="font-family:'Forza-Medium'; font-size:24px; text-align:center; padding-bottom:7px">
                        Oops!</h2>
                    <p style="font-family:'Roboto-Book'; font-size:15px">Missing or incorrect information entered.</p>
                    <p>Please enter a valid entry for each required field highlighted in red.</p>
                    <a href="javascript:hideDiv();" class="btn_pop_close"></a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js?render=<?=$webhelper->GetCaptchaSiteKey()?>"></script>
    <script>
        function checkFrm() {
            var f = document.requestFrm;
            var isOk = true;

            $("#firstname").css("border", "");
            $("#lastname").css("border", "");
            $("#email").css("border", "");
            $("#organization").css("border", "");
            $("#country").css("border", "");
            $("#state").css("border", "");

            if(f.firstname.value == "")
            {
                $("#firstname").css("border", "1px solid #ff0000");
                isOk = false;
            }
            if(f.lastname.value == "")
            {
                $("#lastname").css("border", "1px solid #ff0000");
                isOk = false;
            }
            if(!document.getElementById('email').checkValidity())
            {
                $("#email").css("border", "1px solid #ff0000");
                document.requestFrm.email.focus();
                document.requestFrm.email.reportValidity();
                isOk = false;
            }
            if(f.organization.value == "")
            {
                $("#organization").css("border", "1px solid #ff0000");
                isOk = false;
            }
            if(f.country.value == "")
            {
                $("#country").css("border", "1px solid #ff0000");
                isOk = false;
            }
            if(f.state.value == "")
            {
                $("#state").css("border", "1px solid #ff0000");
                isOk = false;
            }
            if(isOk)
            {
                grecaptcha.ready(function() {
                    grecaptcha.execute('<?=$webhelper->GetCaptchaSiteKey()?>', {action: '/resources/literature/save'}).then(function(token) {
                        document.getElementById('grecaptchaval').value = token;
                        f.submit();
                    });
                });
            }
        }
    </script>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/footer.php") ?>