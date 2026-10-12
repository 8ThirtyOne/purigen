<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/WebHelper.php');
$webhelper = new WebHelper();
$isMobile = WebHelper::isMobile();

if (!isset($dotenv)) {
    require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
    $dotenv->load();
}

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
    <meta name="twitter:card" content="summary"></meta>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/<?= $style ?>?v=<?php echo getenv('CSS_VERSION',true)? getenv('CSS_VERSION',true):5; ?>">
    <link rel="stylesheet" href="../partner/css/index-partner.css<?php echo "?v=".date("YmdGis"); ?>">
    <link rel="preload" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" as="style" onload="this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"></noscript>

    <?php if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false): ?>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-SLPZ4VXYTS"></script>
        
		<script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-SLPZ4VXYTS');
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
	

    <!-- Google Optimize -->

    <script src="https://www.googleoptimize.com/optimize.js?id=OPT-N6MKZ96"></script>


    <!-- Mailchimp Tag -->
	
    <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/0391b69b202f4723ebdb1eef0/7e892765dff9cdfd2eec8f325.js");</script>

    <script type="application/ld+json">

        {
            "@context": "https://schema.org/",
            "@type": "Corporation",
            "name": "Purigen Biosystems",
            "url": "https://www.purigenbio.com/",
            "logo": "https://www.purigenbio.com/images/common/logo-purigen-main-reg.svg",
            "email": "info@purigenbio.com",
            "description": "",
            "address": {
                "@type": "PostalAddress",
                "postalCode": "94588",
                "streetAddress": "5400 Stoneridge Dr., Suite 100",
                "addressCountry": "USA",
                "telephone": "+1 877 787-4436"
            },

            "telephone": "+1 877 787-4436",
            "brand": {
                "@type": "Brand",
                "logo": "https://www.purigenbio.com/images/common/logo-purigen-main-reg.svg",
                "slogan": "Nucleic Acid Purification – Pure and Simple"
            },

            "founder": {
                "@type": "Person",
                "name": "Klint Rose",
                "image": "https://www.linkedin.com/in/klint-rose-a2ab037/",
                "url": "https://www.linkedin.com/in/klint-rose-a2ab037/",
                "jobTitle": "Chief Scientific Officer"
            }
        }

    </script>

    <script type="application/ld+json">

        {
            "@context": "https://schema.org/",
            "@type": "WebSite",
            "name": "Purigen Biosystems",
            "url": "https://www.purigenbio.com",
            "description": "Automated, charge-based extraction of pure DNA, RNA, and miRNA"
        }

    </script>

</head>

<body class="partner-wrap">

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

<?/*php include_once("popup_form.php") */?>

<div id="wrap">

    <header id="header" class="header-desktop">
        <div class="header-gnb">
            <div class="header-gnb-inner">
                <div class="header-gnb-list" id="header-gnb">
                    <ul id="left_nav">

                        <li>LINKS TO MAIN SITE <i class="fas fa-sort-down"></i>
                            <div class="header-gnb-list-sub">
                                <dl>
                                    <dt>Purigen Instrument</dt>
                                    <a href="/products/ionic-system" target="_blank"><img src="https://www.purigenbio.com/images/common/icon-ionic-system-gray-01b.svg" width="20%" style="padding-bottom: 10px">

                                        <dd class="blue_nav_icon" style="font-family: 'Forza-Book'; color: #32383e">Ionic&reg; Purification System</dd></a>

                                </dl>

                                <dl>
                                    <dt>Ionic Kits</dt>
                                    <a href="/products/ionic-kits" target="_blank"><img src="https://www.purigenbio.com/images/common/icon-ionic-chip-gray-01b.svg" width="22%" style="padding-bottom: 5px">
										
                                        <dd style="font-family: 'Forza-Book'; color: #32383e">Ionic&reg; Purification Kits</dd></a>

                                </dl>

                                <dl>
                                    <dt>Ionic Applications</dt>
                                    <dd><a href="/applications/ionic-ffpe-pure-dna" target="_blank">FFPE to Pure DNA</a></dd>
                                    <dd><a href="/applications/ionic-ffpe-pure-rna" target="_blank">FFPE to Pure RNA</a></dd>
                                    <dd><a href="/applications/ionic-ffpe-complete" target="_blank">FFPE Complete - DNA + RNA</a></dd>
                                    <dd><a href="/applications/ionic-tissue-pure-dna" target="_blank">Tissue to Pure DNA</a></dd>
                                    <dd><a href="/applications/ionic-cells-pure-dna" target="_blank">Cells to Pure DNA - Low Input</a></dd>
                                    <dd><a href="/applications/ionic-pure-viral-rna" target="_blank">Pure Viral RNA</a></dd>
                                </dl>
								
								<dl>
                                    <dt>Videos</dt>
                                    <dd><a href="/resources/videos?type=3#a" target="_blank">How-to Videos</a></dd>
                                </dl>
                            </div>
                        </li>

                        <li>ITP TECHNOLOGY <i class="fas fa-sort-down"></i>
                            <div class="header-gnb-list-sub">
                                <dl>
                                    <dd class="blue_nav_icon"><a href="/technology/isotachophoresis" target="_blank">Purigen Isotachophoresis</a></dd>
                                </dl>
								
                            </div>

                        </li>

                        <!--<li>

                            CONTACT SUPPORT (JIRA) <i class="fas fa-angle-double-right"></i>
                            <div class="header-gnb-list-sub">
                                <dl>
                                    <dd class="blue_nav_icon"><a href="/resources/literature">Literature</a></dd>
                                    <dd class="blue_nav_icon"><a href="/resources/videos">Videos</a></dd>
                                    <dd class="blue_nav_icon"><a href="/resources/videos?type=2#a">Webinars</a></dd>
                                    <dd class="blue_nav_icon"><a href="/resources/core-labs">Core Labs</a></dd>
                                    <dd class="blue_nav_icon"><a href="/resources/technical-articles">Technical Articles</a></dd>
                                </dl>
                            </div>  
                        </li>-->

                    </ul>

                    <div id="header_logo">
                        <h1>
                            <a href="/partner/" target="_blank">
                                <img src="/images/common/logo-purigen-main-reg-white.svg" alt="Purigen Biosystems, Inc.">
                            </a>
                        </h1>
                    </div>

                    <ul id="right_nav">

                                           <li class="not-drop">
                                               <a href="https://purigenbio.atlassian.net/servicedesk/customer/portal/5" target="_blank">CONTACT SUPPORT – JIRA <i class="fas fa-angle-double-right"></i></a>
										   </li>


                                           <li class="search_imt">
                                           </li>

                    </ul>
<div class="profile-panel ">
    <span class="text" style="font-size: 13px"> You are logged in as </span>
    <span class="name" style="font-size: 19px; font-family: 'Forza-Bold'; text-transform: uppercase"> <?php echo $username;  ?></span>
    <a href="logout.php" class="text-logout">  <i class="fas fa-sign-out-alt fa-2x"></i></a>
</div>
                </div>
				
                <div class="header-util">

                    <ul>
                        <li><a href="https://twitter.com/purigenbio" target="_blank"><i class="fab fa-twitter-square"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/purigenbiosystems" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="https://www.facebook.com/purigenbio/" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                        <li><a href="https://www.youtube.com/channel/UCpkZHg4ziC5rZzLKVImaFbQ" target="_blank"><i class="fab fa-youtube-square"></i></a></li>
                        <li><a href="/blogs"><i class="fab fa-blogger"></i></a></li>
                        <!--<li class="header-util-request"><a href="/support/request-info">REQUEST INFO // DEMO</a></li>-->
                    </ul>

                </div>

                <div class="header-search" id="header-search">
                    <a href="#"><i class="fal fa-search fa-2x"></i></a>
                </div>

                <div class="header-search-field" id="header-search-field">
                    <form name="headerSearchFrm" method="get" action ="/partner/" data-action="/sphider/search-result.php">
                        <input type="hidden" name="search" value="1"/>
                        <input type="text" name="query_t" value="<?php echo $_GET['query_t']; ?>" autocomplete="off"  data-onkeypress="checkEnterHeader(event);" placeholder="Search for Marketing Assets, Sales Docs, Resources, etc."/>
                    </form>

                    <!--<script async src="https://cse.google.com/cse.js?cx=6b85962e27c628231"></script>-->

                    <!--<div class="gcse-search"></div>-->

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
            <a href="/" target="_blank">
                <img src="/images/logo-purigen-main-white.svg" alt="Purigen Biosystems, Inc.">
            </a>
        </h1>

        <div class="header-mobile-util">
            <a href="#"><i class="fal fa-search fa-2x"></i></a>
        </div>
		
        <div class="header-search-field" id="header-mobile-search-field">

            <form name="headerSearchFrm" method="get" action ="/partner/" data-action="/sphider/search-result.php">
                <input type="hidden" name="search" value="1"/>
                <input type="text" name="query_t" value="<?php echo $_GET['query_t']; ?>" data-onkeypress="checkEnterHeader(event);" placeholder="Search for products, technology, support, etc."/>
            </form>
        </div>

        <div class="header-mobile-menu-list" id="header-mobile-menu-list" style="opacity: 0">
            <ul>
                <li>
                    <a href="#">Products &amp; Apps <i class="fas fa-sort-down"></i></a>
                    <dl>
                        <dt>Purigen Instrument</dt>
                        <dd><a href="/products/ionic-system" target="_blank">Ionic&reg; Purification System</a></dd>

                        <dt>Ionic Kits</dt>
                        <dd><a href="/products/ionic-kits" target="_blank">Ionic&reg; Purification Kits</a></dd>

                        <dt>Ionic Applications</dt>
                        <dd><a href="/applications/ionic-ffpe-pure-dna" target="_blank">FFPE to Pure DNA</a></dd>
                        <dd><a href="/applications/ionic-ffpe-pure-rna" target="_blank">FFPE to Pure RNA</a></dd>
                        <dd><a href="/applications/ionic-ffpe-complete" target="_blank">FFPE Complete - DNA + RNA</a></dd>
                        <dd><a href="/applications/ionic-tissue-pure-dna" target="_blank">Tissue to Pure DNA</a></dd>
                        <dd><a href="/applications/ionic-cells-pure-dna" target="_blank">Cells to Pure DNA - Low Input</a></dd>
                        <dd><a href="/applications/ionic-pure-viral-rna" target="_blank">Pure Viral RNA - Early Access</a></dd>
                    </dl>
                </li>

                <li>
                    <a href="#">Technology <i class="fas fa-sort-down"></i></a>

                    <dl>
                        <dd><a href="/technology/isotachophoresis" target="_blank">Purigen Isotachophoresis</a></dd>
                    </dl>
                </li>

                <!--<li>
                    <a href="#">Resources <i class="fas fa-sort-down"></i></a>
                    <dl>
                        <dd><a href="/resources/literature">Literature</a></dd>
                        <dd><a href="/resources/videos">Videos</a></dd>
                        <dd><a href="/resources/videos?type=2#a">Webinars</a></dd>
                        <dd><a href="/resources/core-labs">Core Labs</a></dd>
                        <dd><a href="/resources/technical-articles">Technical Articles</a></dd>
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
                        <dd><a href="/support/request-info">REQUEST INFO // DEMO</a></dd>
                    </dl>
                </li>

                <li>
                    <a href="#">Company <i class="fas fa-sort-down"></i></a>
                    <dl>
                        <dd><a href="/company/about-us">About Us</a></dd>
                        <dd><a href="/company/careers">Careers</a></dd>
                        <dd><a href="/company/pop-program">POP Program</a></dd>
						<dd><a href="/company/ffpe-grant-challenge">FFPE Grant Challenge 2021</a></dd>
                        <dd><a href="/company/location">Location and Contact</a></dd>
                        <dd><a href="/company/privacy">Privacy and Cookies</a></dd>
                        <dd><a href="/support/request-info">REQUEST INFO</a></dd>
                    </dl>
                </li>-->
            </ul>

            <!--<div class="header-mobile-request">
                <a href="/support/request-info" style="width: 170px">REQUEST INFO // DEMO</a>
            </div>-->

            <div class="header-mobile-follow">

                <h3>FOLLOW US</h3>

                <ul>
                    <li><a href="https://twitter.com/purigenbio" target="_blank"><i class="fab fa-twitter-square smooth-hover"></i></a></li>
                    <li><a href="https://www.linkedin.com/company/purigenbiosystems" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                    <!--<li><a href="https://www.facebook.com/purigenbio/" target="_blank"><i class="fab fa-facebook-square"></i></a></li>-->
                    <li><a href="https://www.youtube.com/channel/UCpkZHg4ziC5rZzLKVImaFbQ" target="_blank"><i class="fab fa-youtube-square"></i></a></li>
                    <li><a href="/blogs"><i style="font-size: 23px" class="fas fa-comment-alt-dots"></i></a></li>
                </ul>
            </div>
        </div>

    </header>
    <!-- //header-mobile -->