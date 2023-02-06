<?php
class UrlController extends BaseController
{
    /** 
    * If method doesn't exist, throws 404 by default
    */
    public function __call($name, $arguments)
    {
        $this->sendResponse('404', '');
    }

    /** 
    * Endpoint /all
    */
    public function all() {
        $responseCode = '200';
        $data = NULL;
        if (strtoupper($_SERVER["REQUEST_METHOD"]) === 'GET') {
            try {
                $urlModel = new UrlModel();
                $arrUrls = $urlModel->getAllUrls();
                $data = json_encode($arrUrls);
            } catch (Error $e) {
                $data = $e->getMessage();
                $responseCode = '500';
            }
        } else {
            $data = 'Method not supported';
            $responseCode = '422';
        }
        
        $this->sendResponse($responseCode, $data);        
    }

    /** 
    * Endpoint /get
    */
    public function get($shortCode = '') {
        if (empty($shortCode)) {
            $this->sendResponse('400', 'Invalid code');
        }

        if (strtoupper($_SERVER["REQUEST_METHOD"]) === 'GET') {
            try {
                $urlModel = new UrlModel();
                $data = $urlModel->getUrl($shortCode);
                
                // if record not found, throw an error
                if (empty($data)) {
                    throw new Error('Record not found');
                }
                
                $data = json_encode($data[0]);
                $responseCode = '200';  
            } catch (Error $e) {
                $data = $e->getMessage();
                $responseCode = '500';
            }
        } else {
            $data = 'Method not supported';
            $responseCode = '422';  
        }

        $this->sendResponse($responseCode, $data);        
    }

    /** 
    * Endpoint /add
    */
    public function add() {
        if (strtoupper($_SERVER["REQUEST_METHOD"]) === 'POST') {
            try {
                $urlModel = new UrlModel();

                // check if url is a valid format
                if (filter_var($_POST['original_url'], FILTER_VALIDATE_URL) === false) {
                    throw new Error('Invalid URL format');
                } else {
                    // sanitize url
                    $url = filter_var($_POST['original_url'], FILTER_SANITIZE_URL);
                    // Add it
                    $data = $urlModel->addUrl($url);
                    // return the short code
                    $data = json_encode($data);
                    $responseCode = '200';  
                }
            } catch (Error $e) {
                $data = $e->getMessage();
                $responseCode = '500';
            }
        } else {
            $data = 'Method not supported';
            $responseCode = '422';  
        }

        $this->sendResponse($responseCode, $data);        
    }
}