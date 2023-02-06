<?php
class BaseController
{
    // If method doesn't exist, throws 404 by default
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }

    /** 
    * Output headers and JSON
    * 
    * @param string $responseCode 
    * @param mixed $data 
    */
    protected function sendResponse($responseCode, $data = '') {
        // Output headers
        header_remove('Set-Cookie');
        header('Content-Type: application/json');
        header(RESPONSE_HEADERS[$responseCode]);
        
        // Send data and exit
        echo $data;
        exit;
    }
}