<?php
/**  
 * Nimble-API-PHP : API v1.0
 *
 * PHP version 5.4.3
 *
 * @namespace Payments
 * @link http://github.com/...
 * @filesource
 */
namespace Nimble\Api;
use Exception;
use \Base\Config\Config;

/**
 * Class responsible for performing payments services.
 */
class Payments
{

    /**
     * Method SendPaymentClient
     *
     * @param object $NimbleApi
     * @param array $context
     * @return array
     */
    public static function SendPaymentClient ($NimbleApi, $context)
    {
        
        if (empty($NimbleApi)) {
            throw new Exception('$NimbleApi parameter is empty.');
        }
        if (empty($context)) {
            throw new Exception('$payment parameter is empty, please enter a payment');
        }
    
        try {
            $NimbleApi->setPostfields(json_encode($context));
            $NimbleApi->uri .= 'payments';
            $NimbleApi->method = 'POST';
            $response = $NimbleApi->rest_api_call();
            return $response;
        }
        catch (Exception $e) {
            throw new Exception('Error in SendPaymentClient: ' . $e);
        }
    }

    /**
     * Method ExecutePaymentClient
     *
     * @param object $NimbleApi
     * @return unknown
     */
     public static function FindPaymentClient ($NimbleApi, $IdPayment)
    {
        if (empty($NimbleApi) || empty($IdPayment) ) {
            throw new Exception('$NimbleApi parameter is empty.');
        }
        try {
            $NimbleApi->uri .= 'payments/'.$IdPayment;
            $NimbleApi->method = 'GET';
            $response = $NimbleApi->rest_api_call();
            return $response;
        }
        catch (Exception $e) {
            throw new Exception('Error in ExecutePaymentClient: ' . $e);
        }
    }
}
