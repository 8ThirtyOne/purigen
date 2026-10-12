<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Constants.php');
$industry_types = Constants::INDUSTRY_TYPES;
$research_types = Constants::RESEARCH_TYPES;

include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
$webhelper = new WebHelper();
?>
<!DOCTYPE html><head>
<title>Request Information | Purigen Biosystems</title>
<meta name="description" content="Contact us to request information on Purigen Ionic Purification System and Kits." />
<link rel="canonical" href="https://www.purigenbio.com/support/request-info" />
<meta content="Request Information | Purigen Biosystems" property="og:title">
<meta content="Request Information | Purigen Biosystems" name="twitter:title">
<meta content="Contact us to request information on Purigen Ionic Purification System and Kits." property="og:description">
<meta content="Contact us to request information on Purigen Ionic Purification System and Kits." name="twitter:description">
<meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" property="og:image">
<meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" name="twitter:image">
<meta content="website" property="og:type">

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/header.php") ?>

</head>


<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#industry_type').select2({
            placeholder: 'Select an option',
            dropdownAutoWidth: true,
        });
        $('#research_type').select2({
            placeholder: 'Select an option',
            dropdownAutoWidth: true,
        });
        // window.addEventListener('load', function () {
        //     let client_id = document.getElementById('ga_client_id').value = ga.getAll()[0].get('clientId');
        // });
    });

    function checkFrm()
    {
        var f = document.requestFrm;
        var isOk = true;
        $("#firstname").css("border", "");
        $("#lastname").css("border", "");
        $("#email").css("border", "");
        $("#phone").css("border", "");
        $("#organization").css("border", "");
        $("#job_title").css("border", "");
        $("#country").css("border", "");
        $("#state").css("border", "");
        $("#research_type").css("border", "");
        $("#main_application").css("border", "");
        $("#purchase_timeline").css("border", "");
        $("#note").css("border", "");
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
            document.requestFrm.email.focus()
            document.requestFrm.email.reportValidity();
            isOk = false;
        }
        if(f.phone.value == "")
        {
            $("#phone").css("border", "1px solid #ff0000");
            isOk = false;
        }
        if($('#research_type').val() == 8)
        {
            if(f.main_application.value == "")
            {
                $("#main_application").css("border", "1px solid #ff0000");
                isOk = false;
            }
        }
        if(f.organization.value == "")
        {
            $("#organization").css("border", "1px solid #ff0000");
            isOk = false;
        }
        if(f.job_title.value == "")
        {
            $("#job_title").css("border", "1px solid #ff0000");
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
        if(f.industry_type.value == "")
        {
            $( "span[aria-labelledby='select2-industry_type-container']").attr("style", "border: 1px solid #ff0000 !important");
            isOk = false;
        } else{
            $( "span[aria-labelledby='select2-industry_type-container']").removeAttr("style");
        }
        if(f.research_type.value == "")
        {
            $( "span[aria-labelledby='select2-research_type-container']").attr("style", "border: 1px solid #ff0000 !important");
            isOk = false;
        } else{
            $( "span[aria-labelledby='select2-research_type-container']").removeAttr("style");
        }
        if(f.purchase_timeline.value == "")
        {
            $("#purchase_timeline").css("border", "1px solid #ff0000");
            isOk = false;
        }
        if(f.note.value == "")
        {
            $("#note").css("border", "1px solid #ff0000");
            isOk = false;
        }
        if(isOk)
        {
            f.submit();
        }else
        {
            if (document.getElementById('email').checkValidity())
            {
                showDiv();
            }
        }
    }
    function showDiv()
    {
        $("#error-msg").show();
    }
    function hideDiv()
    {
        $("#error-msg").hide();
    }

</script>

<div id="container" class="request_info_page">

    <div id="contents" class="none-visual">
        <div class="contents-title">
            <h2><span style="font-size: 36px">Request Info &nbsp; <span style="font-family: 'Forza-Light'">|</span> &nbsp; Request Demo</span></h2>
            <p>Please fill out the form below to get in contact with one of our sales or support associate.</p>
        </div>

        <!-- //contents-title -->

        <form name="requestFrm" method="post" action="/support/request-info-proc.php" >
            <input type="hidden" id="ga_client_id" name="ClientId" value="">
            <input type="hidden" id="grecaptchaval" name="grecaptchaval">

            <div class="form">
                <div class="form-required">* Required</div>
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
                        <dt><label for="">WORK EMAIL* <em>(please do not enter web-based emails like yahoo, gmail, etc.)</em></label></dt>
                        <dd><input type="email" name="email" id="email" maxlength="50" required/></dd>
                    </dl>
                    <dl>
                        <dt><label for="">PHONE*</label></dt>
                        <dd><input type="text" name="phone" id="phone" maxlength="50"/></dd>
                    </dl>
                </div>
                <div class="form-row">
                    <dl>
                        <dt><label for="">ORGANIZATION / INSTITUTION*</label></dt>
                        <dd><input type="text" name="organization" id="organization" maxlength="100"/></dd>
                    </dl>
                    <dl>
                        <dt><label for="">JOB TITLE*</label></dt>
                        <dd><input type="text" name="job_title" id="job_title" maxlength="100"/></dd>
                    </dl>
                </div>
                <div class="form-row">
                    <dl>
                        <dt><label for="">INDUSTRY TYPE*</label></dt>
                        <dd><select class="dropdown" name="industry_type" id="industry_type">
                                <?php foreach ($industry_types as $key => $industry_type) { ?>
                                    <option value="<?= $key ?>"><?= $industry_type ?></option>
                                <?php } ?>
                            </select></dd>
                    </dl>
                    <dl style="position: relative">
                        <dt><label for="">MAIN RESEARCH AREA*</label></dt>
                        <dd>
                            <select class="dropdown" name="research_type" id="research_type">
                                <?php foreach ($research_types as $key => $research_type) { ?>
                                    <option value="<?= $key ?>"><?= $research_type ?></option>
                                <?php } ?>
                            </select>
                        </dd>
                        <dd><input type="text" name="main_application" id="main_application" maxlength="100"  placeholder="Please specify" style="display: none;"/></dd>
                    </dl>
                </div>
                <div class="form-row">
                    <dl>
                        <dt><label for="">COUNTRY*</label></dt>
                        <dd><input type="text" name="country" id="country" maxlength="50"/></dd>
                    </dl>
                    <dl>
                        <dt><label for="">STATE / PROVINCE*</label></dt>
                        <dd><input type="text" name="state" id="state" maxlength="50"/></dd>
                    </dl>
                </div>
                <div class="form-row">
                    <dl>
                        <dt><label for="">PURCHASE TIMELINE*</label></dt>
                        <dd><input type="text" name="purchase_timeline" id="purchase_timeline" maxlength="100"/></dd>
                    </dl>
                    <dl>
                    </dl>
                </div>
                <div class="form-agree">
                    <div class="checkbox-set"><input type="checkbox" name="isreceive" value="1" id="category-brochures"/> <label for="category-brochures">YES, I'd like to receive the latest enews about Purigen.</label></div>
                </div>
                <div class="form-row">
                    <dl>
                        <dt><label for="">COMMENTS OR QUESTIONS*</label></dt>
                        <dd><textarea name="note" id="note"></textarea></dd>
                    </dl>
                </div>
                <div class="form-info">By submitting, you are agreeing to our <a href="/company/privacy.php">Privacy Policy</a>.</strong></div>
                <div class="form-submit">
                    <button type="button" onclick="checkFrm();">SUBMIT</button>
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
                <h2 style="font-family:'Forza-Medium'; font-size:24px; text-align:center; padding-bottom:7px">Oops!</h2>
                <p style="font-family:'Roboto-Book'; font-size:15px">Missing or incorrect information entered.</p>
                <p>Please enter a valid entry for each required field highlighted in red.</p>
                <a href="javascript:hideDiv();" class="btn_pop_close"></a>
            </div>
        </div>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js?render=<?=$webhelper->GetCaptchaSiteKey()?>"></script>
<script type="text/javascript">
    $('#research_type').on('change', function() {
        if (this.value == 8){
            $('#main_application').show();
        } else {
            $('#main_application').hide();
        }
    });

    grecaptcha.ready(function() {
        grecaptcha.execute('<?=$webhelper->GetCaptchaSiteKey()?>', {action: 'request_info'}).then(function(token) {
            document.getElementById('grecaptchaval').value = token;
        });
    });
</script>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/footer.php') ?>