<?php

@ini_set('display_startup_errors', 0);

@error_reporting(E_ALL);

@ini_set("display_errors", 0);



//header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

//header("Cache-Control: post-check=0, pre-check=0", false);

if (!headers_sent()) {

    header("Pragma: no-cache");

    header("Cache: no-cache");

    header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + (60 * 60)));

}
require_once '/var/www/8romans.com/purigen/config/keys.php';
require '/home/fender/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/autoload.php';

$cfg = ActiveRecord\Config::instance();

$cfg->set_model_directory($_SERVER['DOCUMENT_ROOT'] . '/models');

$cfg->set_connections(

    [

        'production' => $db_connection

    ]

);

$cfg->set_default_connection('production');

include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Constants.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/dbHelper.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/RowHelper.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/PageHelper.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/WebHelper.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Routers.php');

?>

