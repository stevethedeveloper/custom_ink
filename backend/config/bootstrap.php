<?php
define("APP_PATH", __DIR__ . "/../");
// Need config, base contgroller, and url model
require_once APP_PATH . "config/config.php";
require_once APP_PATH . "Controller/BaseController.php";
require_once APP_PATH . "Model/UrlModel.php";

// define header responses for convenience
// define() syntax is available in PHP 7+
const RESPONSE_HEADERS = [
    '200' => 'HTTP/1.1 200 OK',
    '400' => 'HTTP/1.1 400 Bad Request',
    '404' => 'HTTP/1.1 404 Not Found',
    '422' => 'HTTP/1.1 422 Unprocessable Entity',
    '500' => 'HTTP/1.1 500 Internal Server Error'
];
