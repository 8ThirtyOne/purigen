<?php

$pages_with_fixed_icon = ['/','/products/ionic-system','/products/ionic-kits','/applications/ionic-ffpe-pure-dna','/applications/ionic-ffpe-pure-rna','/applications/ionic-ffpe-complete','/applications/ionic-tissue-pure-dna','/applications/ionic-pure-viral-rna','/applications/ionic-cells-pure-dna','/company/about-us','/technology/isotachophoresis','/resources/video','/customer-profiles/view/fox-chase-cancer-center-mirna-colorectal-cancer','/customer-profiles/view/identifying-prostate-cancer-biomarkers-from-ffpe','/customer-profiles/view/improving-ffpe-data-extraction-yield-at-fred-hutch-citn'];

if (in_array($_SERVER['REQUEST_URI'], $pages_with_fixed_icon)){ ?>

    <script type="text/javascript" src="/scripts/email-validation.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {

            var formStatus = 0;
            $('#fixed_request_info .title').click(function(event){
                event.preventDefault();

                event.stopPropagation();
                if (!$('#fixed_request_info').is(':animated')) {
                    if (formStatus == 0 ) {
                        $('#fixed_request_info').animate({'height': '460px', 'width': '270px'}, 500)
                            .css('opacity',0.95)
                            .find('.form-question').show();
                        formStatus = 1;

                    } else if (formStatus == 1) {
                        $('#fixed_request_info').animate({'height': '30px', 'width': '157px'}, 500, function() {
                            $(this).find('.form-question').hide();
                        })
                            .css('opacity',1);
                        formStatus = 0;
                    }
                }
            });

            $('#idFormQuestion .btn-success').click(function(e) {
                e.preventDefault()
                processFormQuery(e);
            })
        });

        function processFormQuery(e) {

            var form = $('#idFormQuestion');
            var url = form.attr('action');
            var formValid = true;
            form.find('.error').removeClass("error");

            if (form.find("#firstname").val().length <= 0) {
                form.find("#firstname").addClass('error');
                formValid = false;
            }

            if (form.find("#city_type_zip").val().length <= 0) {
                form.find("#city_type_zip").addClass('error');
                formValid = false;
            }

            if (form.find("#question").val().length <= 0) {
                form.find("#question").addClass('error');
                formValid = false;
            }

            if (!checkEmail(form.find("#email").val())) {
                form.find("#email").addClass('error');
                formValid = false;
            }

            if (formValid) {
                $.ajax({
                    type: "POST",
                    url: url,

                    //dataType: "json",

                    data: form.serialize(), // serializes the form's elements.

                    success: function (data) {

                        let retData;
                        try {
                            retData =  JSON.parse(data);
                        }catch (e) {
                            console.log('error json');
                        }

                        if (retData && retData.hasOwnProperty("status")) {
                            if ( retData['status']) {
                                if ( retData['redirect']) {
                                    document.location.href = retData['redirect'];
                                }else{
                                    alert(retData['message']);
                                }
                            }else{
                                alert(retData['message']);
                            }
                        }else{
                            alert(data);
                        }

                        // show response from the php script.
                        form.trigger("reset");
                    },

                    error: function (data) {
                        console.log("error - ", data);
                    }
                });
            }
            return false;
        };
    </script>

    <div id="fixed_request_info">

        <div class="title">Have questions?<!--<span class="icon-question-mark"></span>--></div>

        <div class="form-question">

            <form name="requestFrm-p" method="post" action="/question/save" id="idFormQuestion">
                <input type="hidden" id="ga_client_id" name="ClientId" value="">
                <input type="hidden" id="grecaptchaval" name="grecaptchaval">
                <div class="g-recaptcha-question" data-sitekey="<?=$webhelper->GetCaptchaSiteKey() ?>" id="RecaptchaField2"></div>
                <input type="hidden" class="hiddenRecaptcha" name="que_hiddenRecaptcha" id="que_hiddenRecaptcha">
                <div class="form-p">

                    <div class="form-row-p">
                        <dl>
                            <dt><input type="text" name="firstname" id="firstname" maxlength="20" required="required" /></dt>
                            <dd><label for="">First Name*</label></dd>
                        </dl>
                    </div>

                    <div class="form-row-p">
                        <dl>
                            <dt><input type="text" name="lastname" id="lastname" maxlength="20"/></dt>
                            <dd><label for="">Last Name</label></dd>
                        </dl>
                    </div>

                    <div class="form-row-p">
                        <dl>
                            <dt><input type="text" name="organization" id="organization" maxlength="100"/></dt>
                            <dd><label for="">Organization / Institution</label></dd>
                        </dl>
                    </div>

                    <div class="form-row-p">
                        <dl>
                            <dt><input type="text" name="city_type_zip" id="city_type_zip" required="required"/></dt>
                            <dd><label for="">City / State or Zip Code*</label></dd>
                        </dl>
                    </div>

                    <div class="form-row-p">
                        <dl>
                            <dt><input type="email" name="email" id="email" required="required"/></dt>
                            <dd><label for="">Email Address*</label></dd>
                        </dl>
                    </div>

                    <div class="form-row-p">
                        <dl>
                            <dt><textarea name="question" id="question" rows="4" required="required"></textarea></dt>
                            <dd><label for="">Question*</label></dd>
                        </dl>
                    </div>

                    <div class="form-submit">
                        <button type="submit" class="btn btn-success" >SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php } ?>