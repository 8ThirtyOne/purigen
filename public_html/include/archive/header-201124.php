<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/WebHelper.php');
$webhelper = new WebHelper();
$isMobile = WebHelper::isMobile();
if (getenv('DEV')){
    $style = 'index.css';
} else {
    $style = 'index.min.css';
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv = "content-language" content = "en">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/<?= $style ?>?v=2.6">
    <link rel="preload" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" as="style" onload="this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"></noscript>
<?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false): ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-68290001-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-68290001-1');
</script>
    
<!-- Google Tag Manager -->
<script>
if(navigator.userAgent.indexOf("Chrome-Lighthouse") == -1) {
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WJ3PHGF');
}
</script>
<!-- End Google Tag Manager -->
    
<!-- Global site tag (gtag.js) - Google Ads: 718871573 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-718871573"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-718871573');
</script>
<?php endif; ?>
    
<!-- Mailchimp Tag -->
<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/0391b69b202f4723ebdb1eef0/7e892765dff9cdfd2eec8f325.js");</script>

</head>

<body>
    
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJ3PHGF"
height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Google reCAPTCHA v3 -->
<!--<script src="https://www.google.com/recaptcha/api.js?render=_6LfH_9wUAAAAANzG8mfGPybG6PgUoSKxATLDcWjo"></script>
<script>
//grecaptcha.ready(function() {
//    grecaptcha.execute('_6LfH_9wUAAAAANzG8mfGPybG6PgUoSKxATLDcWjo_', {action: 'homepage'}).then(function(token) {
//       ...
//    });
//});
</script>-->
<!-- End Google reCAPTCHA v3 -->

<script>
    if(navigator.userAgent.indexOf("Chrome-Lighthouse") == -1) {
        (function () {

            window.ldfdr = window.ldfdr || {};
            (function (d, s, ss, fs) {
                fs = d.getElementsByTagName(s)[0];

                function ce(src) {
                    var cs = d.createElement(s);
                    cs.src = src;
                    setTimeout(function () {
                        fs.parentNode.insertBefore(cs, fs)
                    }, 1);
                }

                ce(ss);
            })(document, 'script', 'https://lftracker.leadfeeder.com/lftracker_v1_bElvO73K0eP7ZMqj.js');
        })();
    }
</script>
<?php
$pages_with_fixed_icon = ['/products/ionic-system','/products/ionic-kits','/appllcations/ionic-ffpe-pure-dna','/applications/ionic-ffpe-pure-rna','/applications/ionic-cells-pure-dna','/company/about-us','/technology/isotachophoresis','/resources/video'];
if (in_array($_SERVER['REQUEST_URI'], $pages_with_fixed_icon)){ ?>
    <a href="/support/request-info" id="fixed_request_info"></a>
<?php } ?>

<div id="wrap">
    <header id="header" class="header-desktop">
        <div class="header-gnb">
            <div class="header-gnb-inner">

                <div class="header-gnb-list" id="header-gnb">
                    <ul id="left_nav">
                        <li>
                            PRODUCTS &amp; APPS <i class="fas fa-sort-down"></i>
                            <div class="header-gnb-list-sub">
                                <dl>
                                    <dt>Purigen Instrument</dt>
                                    <a href="/products/ionic-system"><img src="https://www.purigenbio.com/images/common/icon-ionic-system-gray-01b.svg" width="20%" style="padding-bottom: 10px">
                                    <dd class="blue_nav_icon">Ionic&reg; Purification System</a></dd>

                                </dl>
                                <dl>
                                    <dt>Ionic Kits</dt>
                                    <a href="/products/ionic-kits"><img src="https://www.purigenbio.com/images/common/icon-ionic-chip-gray-01b.svg" width="22%" style="padding-bottom: 10px">
                                    <dd>Ionic&reg; Purification Kits</a></dd>
                                </dl>
                                <dl>
                                    <dt>Ionic Applications</dt>
                                    <dd><a href="/applications/ionic-ffpe-pure-dna">FFPE to Pure DNA</a></dd>
                                    <dd><a href="/applications/ionic-ffpe-pure-rna">FFPE to Pure RNA <sup style="font-family: 'Forza-Bold'; color: #427cbf; font-size: 10px">NEW</sup></a></dd>
                                    <dd><a href="/applications/ionic-cells-pure-dna">Cells to Pure DNA</a></dd>
                                </dl>
                            </div>
                        </li>

                        <li>
                            TECHNOLOGY <i class="fas fa-sort-down"></i>
                            <div class="header-gnb-list-sub">
                                <dl>
                                    <dd class="blue_nav_icon"><a href="/technology/isotachophoresis">Purigen Isotachophoresis</a></dd>
                                </dl>

                            </div>
                        </li>

                        <li>
                            RESOURCES <i class="fas fa-sort-down"></i>
                            <div class="header-gnb-list-sub">
                                <dl>
                                    <dd class="blue_nav_icon"><a href="/resources/literature">Literature</a></dd>
                                    <dd class="blue_nav_icon"><a href="/resources/videos">Videos</a></dd>
                                    <dd class="blue_nav_icon"><a href="/resources/videos?type=2#a">Webinars</a></dd>
                                </dl>
                            </div>
                        </li>
                        
                    </ul>

                    <div id="header_logo">
                        <h1>
                            <a href="/">
                                <img src="/images/common/logo-purigen-main-white.svg" alt="Purigen Biosystems, Inc.">
                            </a>
                        </h1>
                    </div>
                    <ul id="right_nav">
                        <li>
                            NEWS &amp; EVENTS <i class="fas fa-sort-down"></i>
                            <div class="header-gnb-list-sub">
                                <dl>
                                    <dd class="blue_nav_icon"><a href="/news-events/news/list">News and Articles</a></dd>
                                    <dd class="blue_nav_icon"><a href="/news-events/press/list">Press Releases</a></dd>
                                    <dd class="blue_nav_icon"><a href="/news-events/events/list">Events</a></dd>
                                    <dd class="blue_nav_icon"><a href="/blogs">Blogs</a></dd>
                                </dl>
                            </div>
                        </li>

                        <li>
                            SUPPORT <i class="fas fa-sort-down"></i>
                            <div class="header-gnb-list-sub">
                                <dl>
                                    <dd class="blue_nav_icon"><a  href="/support/documentation">Documentation</a></dd>
                                    <dd class="blue_nav_icon"><a  href="/resources/videos?type=3#a">How-to Videos</a></dd>
                                    <dd class="blue_nav_icon"><a  href="/support/request-info">Request Information</a></dd>
                                </dl>
                            </div>
                        </li>

                        <li>
                            COMPANY <i class="fas fa-sort-down"></i>
                            <div class="header-gnb-list-sub">
                                <dl>
                                    <dd class="blue_nav_icon"><a href="/company/about-us">About Us</a></dd>
                                    <dd class="blue_nav_icon"><a href="https://purigen.co/2ScnpQv" target="_blank">Giveaway Survey <sup style="font-family: 'Forza-Bold'; color: #427cbf; font-size: 10px">NEW</sup></a></dd>
                                    <dd class="blue_nav_icon"><a href="/company/grant-program">Grant Program <sup style="font-family: 'Forza-Bold'; color: #427cbf; font-size: 10px">NEW</sup></a></dd>
                                    <dd class="blue_nav_icon"><a href="/company/careers">Careers</a></dd>
                                    <dd class="blue_nav_icon"><a href="/company/location">Location and Contact</a></dd>
                                    <dd class="blue_nav_icon"><a href="/company/privacy">Privacy and Cookies</a></dd>
                                </dl>
                            </div>
                        </li>
                        <li class="search_imt">
                        </li>
                    </ul>

                </div>

                <div class="header-util">
                    <ul>
                        <li><a href="https://twitter.com/purigenbio" target="_blank"><i class="fab fa-twitter-square"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/purigenbiosystems" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="https://www.facebook.com/purigenbio/" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                        <li><a href="https://www.youtube.com/channel/UCpkZHg4ziC5rZzLKVImaFbQ" target="_blank"><i class="fab fa-youtube-square"></i></a></li>
                        <li><a href="/blogs"><i style="font-size: 23px" class="fas fa-comment-alt-dots"></i></a></li>
                        <li class="header-util-request"><a href="/support/request-info">REQUEST INFO</a></li>
                    </ul>
                </div>

                <div class="header-search" id="header-search">
                    <a href="#"><i class="fal fa-search fa-2x"></i></a>
                </div>

                <div class="header-search-field" id="header-search-field">
                    <form name="headerSearchFrm" method="get" action="/sphider/search-result.php">
                        <input type="hidden" name="search" value="1"/>
                        <input type="text" name="query_t" value="" onkeypress="checkEnterHeader(event);" placeholder="Search for products, technology, support, etc."/>
                    </form>
                </div>

            </div>
        </div>

        <div class="header-gnb-sub" id="header-gnb-sub"><div></div></div>
    </header>

    <!-- //header -->
    <header id="header-mobile">
        <div class="header-mobile-menu" id="header-mobile-menu">
            <a href="#"><i class="fal fa-bars fa-3x"></i></a>
        </div>

        <h1>
            <a href="/">
                <img src="/images/logo-purigen-main-white.svg" alt="Purigen Biosystems, Inc.">
            </a>
        </h1>

        <div class="header-mobile-util">
            <a href="#"><i class="fal fa-search fa-2x"></i></a>
            <a href="/support/request-info" class="header-mobile-util-request">REQUEST INFO</a>
        </div>

        <div class="header-search-field" id="header-mobile-search-field">
            <form name="headerSearchMobileFrm" method="get" action="/sphider/search-result.php">
                <input type="hidden" name="search" value="1"/>
                <input type="text" name="query_t" value="" onkeypress="checkEnterHeaderMobile(event);" placeholder="Search for products, technology, support, etc."/>
            </form>
        </div>

        <div class="header-mobile-menu-list" id="header-mobile-menu-list" style="opacity: 0">
            <ul>
                <li>
                    <a href="#">Products &amp; Apps <i class="fas fa-sort-down"></i></a>
                    <dl>
                        <dt>Purigen Instrument</dt>
                        <dd><a href="/products/ionic-system">Ionic&reg; Purification System</a></dd>
                        <dt>Ionic Kits</dt>
                        <dd><a href="/products/ionic-kits">Ionic&reg; Purification Kits</a></dd>
                        <dt>Ionic Applications</dt>
                        <dd><a href="/applications/ionic-ffpe-pure-dna">FFPE to Pure DNA</a></dd>
                        <dd><a href="/applications/ionic-ffpe-pure-rna">FFPE to Pure RNA <sup style="font-family: 'Forza-Bold'; color: #427cbf; font-size: 12px">NEW</sup></a></dd>
                        <dd><a href="/applications/ionic-cells-pure-dna">Cells to Pure DNA</a></dd>
                    </dl>
                </li>

                <li>
                    <a href="#">Technology <i class="fas fa-sort-down"></i></a>
                    <dl>
                        <dd><a href="/technology/isotachophoresis">Purigen Isotachophoresis</a></dd>
                    </dl>
                </li>
                
                <li>
                    <a href="#">Resources <i class="fas fa-sort-down"></i></a>
                    <dl>
                        <dd><a href="/resources/literature">Literature</a></dd>
                        <dd><a href="/resources/videos">Videos</a></dd>
                        <dd><a href="/resources/videos?type=2#a">Webinars</a></dd>
                    </dl>
                </li>

                <li>
                    <a href="#">NEWS &amp; EVENTS <i class="fas fa-sort-down"></i></a>
                    <dl>
                        <dd><a href="/news-events/news/list">News and Articles</a></dd>
                        <dd><a href="/news-events/press/list">Press Releases</a></dd>
                        <dd><a href="/news-events/events/list">Events</a></dd>
                        <dd><a href="/blogs">Blogs</a></dd>
                    </dl>
                </li>

                <li>
                    <a href="#">Support <i class="fas fa-sort-down"></i></a>
                    <dl>
                        <dd><a href="/support/documentation">Documentation</a></dd>
                        <dd><a href="/resources/videos?type=3#a">How-to Videos</a></dd>
                        <dd><a href="/support/request-info">Request Information</a></dd>
                    </dl>
                </li>

                <li>
                    <a href="#">Company <i class="fas fa-sort-down"></i></a>
                    <dl>
                        <dd><a href="/company/about-us">About Us</a></dd>
                        <dd><a href="https://purigen.co/2ScnpQv" target="_blank">Giveaway Survey <sup style="font-family: 'Forza-Bold'; color: #427cbf; font-size: 10px">NEW</sup></a></dd>
                        <dd><a href="/company/grant-program">Grant Program <sup style="font-family: 'Forza-Bold'; color: #427cbf; font-size: 10px">NEW</sup></a></dd>
                        <dd><a href="/company/careers">Careers</a></dd>
                        <dd><a href="/company/location">Location and Contact</a></dd>
                        <dd><a href="/company/privacy">Privacy and Cookies</a></dd>
                    </dl>
                </li>

            </ul>

            <div class="header-mobile-request">
                <a href="/support/request-info">REQUEST INFO</a>
            </div>

            <div class="header-mobile-follow">
                <h3>FOLLOW US</h3>
                <ul>
                    <li><a href="https://twitter.com/purigenbio" target="_blank"><i class="fab fa-twitter-square smooth-hover"></i></a></li>
                    <li><a href="https://www.linkedin.com/company/purigenbiosystems" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="https://www.facebook.com/purigenbio/" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                    <li><a href="https://www.youtube.com/channel/UCpkZHg4ziC5rZzLKVImaFbQ" target="_blank"><i class="fab fa-youtube-square"></i></a></li>
                    <li><a href="/blogs"><i style="font-size: 23px" class="fas fa-comment-alt-dots"></i></a></li>
                </ul>
            </div>
        </div>
    </header>
    <!-- //header-mobile -->