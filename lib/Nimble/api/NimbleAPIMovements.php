<?php

/**
 * Nimble-API-PHP : API v1.2
 *
 * PHP version 5.2
 *
 * @link https://github.com/nimblepayments/sdk-php
 * @filesource
 */
class NimbleAPIMovements {
    
    /*
     * Get all movements
     */
    public static function getMovements($NimbleApi){
        //TODO
        throw new Exception('TO DO: getMovements()');
        
        if (empty($NimbleApi)) {
            throw new Exception('$NimbleApi parameter is empty.');
        }

        try {
            //HEADERS
            //$this->authorization->buildAuthorizationHeader('tsec');
            $NimbleApi->authorization->addHeader('Content-Type', 'application/json');
            $NimbleApi->authorization->addHeader('Accept', 'application/json');
            
            $NimbleApi->uri = 'movements';
            $NimbleApi->method = 'GET';
            $response = $NimbleApi->restApiCall();
            return $response;
        } catch (Exception $e) {
            throw new Exception('Error in getMovements: ' . $e);
        }
    }
    
    /*
     * Get Movements Summary: Balance
     */
    public static function getSummary($NimbleApi){
        //TODO
        //$NimbleApi->uri = 'movements/summary';
    }
}
