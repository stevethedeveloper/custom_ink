<?php
require __DIR__ . "/config/bootstrap.php";
$url = parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH);
$uri = explode( '/', $uri );
if ((isset($uri[1]) && $uri[1] != 'url') || !isset($uri[2])) {
    header(RESPONSE_HEADERS['404']);
    exit();
}
require APP_PATH . "/Controller/UrlController.php";
$urlController = new UrlController();
$methodName = $uri[2];
$urlController->{$methodName}();
?>