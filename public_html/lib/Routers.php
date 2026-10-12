<?php

use controllers\BlogController;
use controllers\CustomerProfileController;
use controllers\EventController;
use controllers\LiteratureController;
use controllers\QuestionController;
use controllers\VideoController;
use controllers\PressController;
use controllers\CoreLabController;
use controllers\TechnicalArticleController;

$dispatcher = FastRoute\simpleDispatcher(static function (FastRoute\RouteCollector $r) {
    $r->addRoute('POST', '/question/save', QuestionController::class.'/actionSave');
    $r->addRoute('GET', '/news-events/event.php/{slug}', EventController::class.'/actionIndex');
    $r->addRoute('GET', '/news-events/event/{slug}', EventController::class.'/actionIndex');
    $r->addRoute('POST', '/news-events/event/save', EventController::class.'/actionSave');
    $r->addRoute('GET', '/news-events/event/register/{slug}', EventController::class.'/actionRegister');
    $r->addRoute('GET', '/resources/literature', LiteratureController::class.'/actionIndex');
    $r->addRoute('GET', '/resources/literature/register/{slug}', LiteratureController::class.'/actionRegister');
    $r->addRoute('POST', '/resources/literature/save', LiteratureController::class.'/actionSave');
    $r->addRoute('POST', '/resources/literature/thank', LiteratureController::class.'/actionThankPage');
    $r->addRoute('GET', '/resources/videos', VideoController::class.'/actionIndex');
    $r->addRoute('GET', '/resources/video', VideoController::class.'/actionRedirect');
    $r->addRoute('GET', '/resources/videos/register/{slug}', VideoController::class.'/actionRegister');
    $r->addRoute('POST', '/resources/videos/save', VideoController::class.'/actionSave');
    $r->addRoute('POST', '/resources/videos/thank-page', VideoController::class.'/actionThankPage');
    $r->addRoute('GET', '/resources/core-labs', CoreLabController::class.'/actionIndex');
    $r->addRoute('GET', '/resources/core-labs/view/{slug}', CoreLabController::class.'/actionView');
    $r->addRoute('GET', '/resources/technical-articles', TechnicalArticleController::class.'/actionIndex');
    $r->addRoute('GET', '/resources/technical-articles/view/{slug}', TechnicalArticleController::class.'/actionView');
    $r->addRoute('GET', '/resources/videos/view/{slug}', VideoController::class.'/actionView');
    $r->addRoute('GET', '/blogs/', BlogController::class.'/actionIndex');
    $r->addRoute('GET', '/blogs/view/{slug}', BlogController::class.'/actionView');
    $r->addRoute('GET', '/customer-profiles/', CustomerProfileController::class.'/actionIndex');
    $r->addRoute('GET', '/customer-profiles/view/{slug}', CustomerProfileController::class.'/actionView');
    $r->addRoute('GET', '/news-events/press/list', PressController::class.'/actionIndex');
    $r->addRoute('GET', '/news-events/press/view', PressController::class.'/actionRedirect');
    $r->addRoute('GET', '/news-events/press/{slug}', PressController::class.'/actionView');

});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        list($class, $method) = explode('/', $handler, 2);
        call_user_func_array(array(new $class, $method), $vars);
        break;
}