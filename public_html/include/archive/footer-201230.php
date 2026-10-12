<?php
?>
<footer id="footer">
    <div class="footer-inner">
        <div class="footer-logo">
            <img class="lazy" data-src="/images/common/icon-tagline-purigen-reg-white.svg" alt="Nucleic Acid Purification – Pure and Simple"/>
        </div>
        <!-- //footer-logo -->
        <div class="footer-menu">
            <dl>
                <dt>Products &amp; Apps</dt>
                <dd><a href="/products/ionic-system">Ionic&reg; Purification System</a></dd>
                <dd><a href="/products/ionic-kits">Ionic&reg; Purification Kits</a></dd>
                <dd><a href="/applications/ionic-ffpe-pure-dna">Ionic&reg; FFPE to Pure DNA</a></dd>
                <dd><a href="/applications/ionic-ffpe-pure-rna">Ionic&reg; FFPE to Pure RNA</a></dd>
                <dd><a href="/applications/ionic-cells-pure-dna">Ionic&reg; Cells to Pure DNA</a></dd>
            </dl>
            <dl>
                <dt>Technology</dt>
                <dd><a href="/technology/isotachophoresis">Purigen Isotachophoresis</a></dd>
            </dl>
            <dl>
                <dt>Resources</dt>
                <dd><a href="/resources/literature">Literature</a></dd>
                <dd><a href="/resources/videos">Videos</a></dd>
                <dd><a href="/resources/videos?type=2#a">Webinars</a></dd>
            </dl>
            <dl>
                <dt>News &amp; Events</dt>
                <dd><a href="/news-events/news/list">News and Articles</a></dd>
                <dd><a href="/news-events/press/list">Press Releases</a></dd>
                <dd><a href="/news-events/events/list">Events</a></dd>
                <dd><a href="/blogs">Blogs</a></dd>
            </dl>
            <dl>
                <dt>Support</dt>
                <dd><a href="/support/documentation">Documentation</a></dd>
                <dd><a href="/resources/videos?type=3#a">How-to Videos</a></dd>
                <dd><a href="/support/request-info">Request Information</a></dd>
            </dl>
            <dl>
                <dt>Company</dt>
                <dd><a href="/company/about-us">About Us</a></dd>
                <dd><a href="https://purigen.co/2ScnpQv" target="_blank">Giveaway Survey</a></dd>
                <dd><a href="/company/grant-program">Grant Program</a></dd>
                <dd><a href="/company/careers">Careers</a></dd>
                <dd><a href="/company/location">Location and Contact</a></dd>
                <dd><a href="/company/privacy">Privacy and Cookies</a></dd>
            </dl>
        </div>
        <!-- //footer-menu -->
        <div class="footer-newsletter">
            <h3>Sign up for our e-newsletter to get the latest information on Purigen products and news.</h3>
            <p>Please enter your WORK email address only. Common addresses like gmail, yahoo, hotmail will not be accepted.</p>
            <form name="footermailFrm" method="post" action="/support/signup_proc.php">
                <div class="g-recaptcha-quote" data-sitekey="<?=$webhelper->GetCaptchaSiteKey() ?>" id="RecaptchaField1"></div>
                <input type="hidden" class="hiddenRecaptcha" name="qt_hiddenRecaptcha" id="qt_hiddenRecaptcha">
                <div class="footer-newsletter-field">
                    <input type="text" name="firstname" id="footer_firstname" maxlength="20" placeholder="First Name"  />
                    <input type="text" name="lastname" id="footer_lastname" maxlength="20" placeholder="Last Name" />
                </div>
                <div class="footer-newsletter-field">
                    <input type="text" name="email" id="footer_email" maxlength="50" placeholder="Enter work email address" /> <button type="button" onclick="checkFooterMailFrm();">SIGN UP</button>
                </div>
            </form>
        </div>
        <!-- //footer-newsletter -->
        <div class="footer-follow">
            <dl>
                <dt>FOLLOW US</dt>
                <dd><a href="https://twitter.com/purigenbio" target="_blank"><i class="fab fa-twitter-square fa-3x"></i></a></dd>
                <dd><a href="https://www.linkedin.com/company/purigenbiosystems" target="_blank"><i class="fab fa-linkedin fa-3x"></i></a></dd>
                <dd><a href="https://www.facebook.com/purigenbio/" target="_blank"><i class="fab fa-facebook-square fa-3x"></i></a></dd>
                <dd><a href="https://www.youtube.com/channel/UCpkZHg4ziC5rZzLKVImaFbQ" target="_blank"><i class="fab fa-youtube-square fa-3x"></i></a></dd>
            </dl>
        </div>
        <!-- //footer-follow -->
        <div class="footer-info">
            <img class="lazy" data-src="/images/common/logo-purigen-reg-white.svg" alt="Purigen Biosystems">
        </div>
        <!-- //footer-copyright -->
        <div class="footer-copyright">
            <p><strong>FOR RESEARCH USE ONLY.</strong> Not for use in diagnostic procedures.</p>
            <ul>
                <li><span style="font-family: 'Forza-Medium'">PURIGEN BIOSYSTEMS</span>&nbsp;&nbsp; | &nbsp;&nbsp;5700 Stoneridge Dr, Ste 100, Pleasanton, CA 94588</li>
                <li><a href="/company/privacy">PRIVACY POLICY</a></li>
                <li><a href="/support/request-info">REQUEST INFO</a></li>
                <li><a href="/support/request-info">+1 877 787-4436</a></li>
                <!--<li>TEL: +1 925 264-1364</li>-->
            </ul>
            <address><strong>© 2020 Purigen Biosystems, Inc.</strong> All rights reserved.</address>
        </div>
    </div>
    <!-- //footer-info -->
    </footer>
    <!-- //footer -->
</div>
<!-- //wrap -->
<div id="error-email" style="display: none" class="pop_wrap">
    <div>
        <div>
            <div class="pop_data">
                <h2 style="font-family:'Forza-Medium'; font-size:24px; text-align:center; padding-bottom:7px">Oops!</h2>
                <p style="font-family:'Roboto-Book'; font-size:15px">Please enter your work email address only.</p>
                <p>Common address <i>i.e.,</i> yahoo, hotmail, gmail cannot be accepted.</p>
                <a href="javascript:hideEmailDiv();" class="btn_pop_close"></a>
            </div>
        </div>
    </div>
</div>
<script src="//kit.fontawesome.com/a929b7cf75.js"></script>
<script defer src="/scripts/ui.min.js?v=1.4"></script>
<script async src="/scripts/email-validation.js"></script>
<script>
    !function(window){
        var $q = function(q, res){
                if (document.querySelectorAll) {
                    res = document.querySelectorAll(q);
                } else {
                    var d=document
                        , a=d.styleSheets[0] || d.createStyleSheet();
                    a.addRule(q,'f:b');
                    for(var l=d.all,b=0,c=[],f=l.length;b<f;b++)
                        l[b].currentStyle.f && c.push(l[b]);

                    a.removeRule(0);
                    res = c;
                }
                return res;
            }
            , addEventListener = function(evt, fn){
                window.addEventListener
                    ? this.addEventListener(evt, fn, false)
                    : (window.attachEvent)
                    ? this.attachEvent('on' + evt, fn)
                    : this['on' + evt] = fn;
            }
            , _has = function(obj, key) {
                return Object.prototype.hasOwnProperty.call(obj, key);
            }
        ;

        function loadImage (el, fn) {
            var img = new Image()
                , src = el.getAttribute('data-src');
            img.onload = function() {
                if (!! el.parent)
                    el.parent.replaceChild(img, el)
                else
                    el.src = src;

                fn? fn() : null;
            }
            img.src = src;
        }

        function elementInViewport(el) {
            var rect = el.getBoundingClientRect()

            return (
                rect.top    >= 0
                && rect.left   >= 0
                && rect.top <= (window.innerHeight || document.documentElement.clientHeight)
            )
        }

        var images = new Array()
            , query = $q('img.lazy')
            , processScroll = function(){
                for (var i = 0; i < images.length; i++) {
                    if (elementInViewport(images[i])) {
                        loadImage(images[i], function () {
                            images.splice(i, i);
                        });
                    }
                };
            }
        ;
        // Array.prototype.slice.call is not callable under our lovely IE8
        for (var i = 0; i < query.length; i++) {
            images.push(query[i]);
        };

        processScroll();
        addEventListener('scroll',processScroll);

    }(this);

    if(navigator.userAgent.indexOf("Chrome-Lighthouse") == -1) {
        let script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://www.google.com/recaptcha/api.js?&render=<?=$webhelper->GetCaptchaSiteKey() ?>&onload=onloadCallback';
        document.getElementsByTagName('head')[0].appendChild(script);
    }

    window.verifyCallback = function() {
        grecaptcha.ready(() => {
            // debugger;
            grecaptcha.execute('<?=$webhelper->GetCaptchaSiteKey() ?>', {action: 'subscribe'}).then((token) => {
                document.getElementById('qt_hiddenRecaptcha').value = token;
            });
        });
    };

    var onloadCallback = function() {
        var widgetId1;
        widgetId1 = grecaptcha.render(
            document.getElementById('RecaptchaField1'),
            {
                sitekey : '<?=$webhelper->GetCaptchaSiteKey() ?>',
                callback : window.verifyCallback(),
                size: 'invisible'
            },
            true
        );
    };
</script>
</body>
</html>