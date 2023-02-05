<?php
class UrlController extends BaseController
{
    /** 
    * __call magic method, throws 404 by default
    */
    public function __call($name, $arguments)
    {
        $this->sendResponse('404', '');
    }

    /** 
    * "/urls/all" Endpoint
    */
    public function all() {
        $errorString = '';
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
}