<!DOCTYPE html><head>    
<title>Purigen Isotachophoresis | Purigen Biosystems</title>
<meta name="description" content="Purigen isotachophoresis separates and extracts nucleic acids freely in solution without binding or stripping from a physical surface." />
<link rel="canonical" href="https://www.purigenbio.com/technology/isotachophoresis" />
<meta content="Purigen Isotachophoresis | Purigen Biosystems" property="og:title">
<meta content="Purigen Isotachophoresis | Purigen Biosystems" name="twitter:title">
<meta content="Purigen isotachophoresis separates and extracts nucleic acids freely in solution without binding or stripping from a physical surface." property="og:description">
<meta content="Purigen isotachophoresis separates and extracts nucleic acids freely in solution without binding or stripping from a physical surface." name="twitter:description">
<meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" property="og:image">
<meta content="https://www.purigenbio.com/images/common/logo-purigen-social.jpg" name="twitter:image">
<meta content="website" property="og:type">
<meta content="Purigen Biosystems | Pure DNA Extraction" property="og:site_name">
<meta content="summary" name="twitter:card">
<meta content="@purigenbio" name="twitter:site">
<meta content="1600" property="og:image:width">
<meta content="400" property="og:image:height">

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/header.php") ?>
</head>


<div id="container">
    <div class="technology-visual-outer">
            <div class="technology-visual">
                    <h1>Purigen Isotachophoresis for Pure DNA and RNA Extraction</h1>
                    <div class="technology-visual-movie">
                        <div id="player1" class="elementor-video-iframe" allowfullscreen=""></div>
                    </div>

            </div>
		
            <div class="technology-visual-request">
            	<dl>
                	<dt>The Revolutionary Nucleic Acid Purification Technology</dt>
                	<dd>Move beyond 20+ year-old DNA extraction methods</dd>
                </dl>
                	<a href="/media/pdf/BRH-Purigen-Ionic-System.pdf">VIEW BROCHURE</a>
       		</div>
		
	<!-- purigen newsletter -->
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/news.php') ?>
    <!--//purigen newsletter -->
		
    </div>
    <!-- //technology-visual -->

    <div id="contents" class="contents-pd0">

            <div class="technology-solution">
                    <dl>
                            <dt>The Problem</dt>
                            <dd>
                                    <div class="technology-visual-movie">
                                        <div id="player2" class="elementor-video-iframe" allowfullscreen=""></div>
                                    </div>
                                    <p>&nbsp;</p>
                                    <p>Column, bead, and precipitation-based kits used for extracting nucleic acids all follow the same fundamental workflow.</br></br></p>
        
                                    <div><img class="lazy" data-src="/images/icon-traditional-method.svg" width="45%" alt="Traditional DNA Extraction Method"/></div></br>

                                    <p>Cellular lipid membranes are broken down through the use of detergents, releasing proteins and nucleic acids into a solution. Proteases cleave proteins and strong salts, termed chaotropic salts, will further denature them along with dehydrating molecules.</br></br></p>

                            </dd>
                    </dl>
                    <dl>
                            <dt>The Solution</dt>
                            <dd>
                                    <div class="technology-visual-movie">
                                            <div id="player3" class="elementor-video-iframe" allowfullscreen=""></div>
                                    </div>
                                    <p>&nbsp;</p>
                                    <p>Charge is a fundamental attribute of any biological molecule; in solution, it can be used not only to separate molecules, but also to concentrate and focus them.</p>
                                    
                                    <div><img class="lazy" data-src="/images/icon-purigen-itp.svg" width="70%" style="padding-top:10px; padding-bottom:4px" alt="Purigen Charged-basee DNA Extraction"/></div></br>

                                    <p>Standard separation techniques commonly rely on multiple analyte properties, such as differences in charge, size, solubility, and/or binding affinity, in addition to a solid surface. Isotachophoresis separates and focuses charged molecules in solution solely based on their ionic mobility.</p>
                            </dd>
                    </dl>
            </div>
            <!-- //technology-solution -->

            <div class="technology-article">
                    <div class="technology-article-inner">
                            <h3>A Superior Approach to Nucleic Acid Purification</h3>
                            <article>
                                    Isotachophoresis separates and concentrates charged molecules in solution solely based on their electrophoretic mobility.</br> Biological samples are gently lysed and added to the Purigen <a href="/products/ionic-kits" style="font-family: 'Forza-Medium'; color: #ffffff">Ionic&reg; Fluidic Chip</a>. An electric field is then applied to the chip and </br>the nucleic acid is isolated in its natural, native form. The nucleic acid is not denatured or dehydrated, and there is no binding to, </br>or stripping from, fixed surfaces. The result is a higher yield of pure nucleic acid that is less fragmented and free from </br>bead or wash buffer contamination.
                            </article>
                    </div>
            </div>
            <!-- //technology-article-->

            <div class="sample-solution">
                    <h3>Simple Charge-based Sample Prep in Solution</h3>
                    <div class="sample-solution-inner"><img class="lazy" data-src="/images/technology/fig-simple-charge-based-03h.svg" alt="Purigen Charge-based Sample Prep" width="95%"/></div>
            </div>
            <!-- //sample-solution -->

    </div>
    <!-- //contents -->
</div>

	<!-- pop program -->
		<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/include/pop-program.php') ?>
	<!--//pop program -->

<script defer>
    if(navigator.userAgent.indexOf("Chrome-Lighthouse") == -1) {
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player;

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player1', {
                height: '315',
                width: '560',
                videoId: 'C9v9O0egC54',
            });
            player = new YT.Player('player2', {
                height: '315',
                width: '560',
                videoId: 'nVn2l_XGAHg',
            });
            player = new YT.Player('player3', {
                height: '315',
                width: '560',
                videoId: 'v4no_iuBYJg',
            });
        }

    }
</script>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/view/featured_content/ionic-ffpe.php') ?>
<!-- //container -->
<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/include/footer.php") ?>