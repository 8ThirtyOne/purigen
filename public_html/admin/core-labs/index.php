<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/core-labs/CoreLabs.php');

try {
    $controller = new CoreLabs();
} catch (Exception $e) {
    print_r($e);
    exit();
}
if (isset($_GET['slug']) && !empty( $_GET['slug'] )) {
    $action = 'action'.ucfirst($_GET['slug']);

    if (method_exists($controller, $action)) {
        call_user_func(array($controller, $action));
    }
}

$controller->actionIndex();