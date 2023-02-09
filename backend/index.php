<?php
// This is temporary and the origin below should not be a wildcard, and will depend on how the front and back are deployed
// This backend is currently secured by .htaccess
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, DELETE, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {    
    return 0;    
 }    
// End temporary headers

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