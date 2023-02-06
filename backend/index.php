<?php
require __DIR__ . "/config/bootstrap.php";
$uri = parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH);
$uri = explode( '/', $uri );
if ((isset($uri[1]) && $uri[1] != 'url') || !isset($uri[2])) {
    header(RESPONSE_HEADERS['404']);
    exit();
}
require APP_PATH . "/Controller/UrlController.php";
$urlController = new UrlController();

// TODO:  Better routing, this is quick and dirty.
// Frameworks offer routing out of the box, or a routing class can be created
// to handle a wider number of scenarios.
$methodName = $uri[2];
$param = (isset($uri[3])) ? $uri[3] : NULL;
$urlController->{$methodName}($param);
?>