<?php
require_once(__DIR__.'/../base/NimbleAPIConfig.php');

/**
 * Class responsible for performing payments services.
 */
class NimbleAPICredentials
{

    /**
     * Validates mode corresponds with credentials
     * 
     * @param type $NimbleApi
     * @return type
     * @throws Exception
     */
    public static function check($NimbleApi)
    {
        
        if (empty($NimbleApi)) {
            throw new Exception('$NimbleApi parameter is empty.');
        }
    
        try {
            //HEADERS
            //$this->authorization->buildAuthorizationHeader('tsec');
            $NimbleApi->authorization->addHeader('Content-Type', 'application/json');
            $NimbleApi->authorization->addHeader('Accept', 'application/json');
            
            $NimbleApi->setUri('check');
            $NimbleApi->method = 'GET';
            $response = $NimbleApi->restApiCall();
            return $response;
        } catch (Exception $e) {
            throw new Exception('Error in NimbleAPICredentials::check(): ' . $e);
        }
    }
}