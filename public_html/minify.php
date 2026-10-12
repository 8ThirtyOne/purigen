<body style="font-family: monospace;">
<?php
include_once('minifier.php');

/* FILES ARRAYs
 * Keys as input, Values as output */

$js = array(
//    "js/iframe.js" 			=> "js/iframe.min.js",
    "scripts/ui.js" 			=> "scripts/ui.min.js"
);

$css = array(
//    "css/application.css"	=> "css/application.min.css",
    "css/index.css"			=> "css/index.min.css"
);

minifyJS($js);
minifyCSS($css);
?>
</body>