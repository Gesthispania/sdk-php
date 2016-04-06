<?php
/**
 * Nimble-API-PHP : API v1.2
 *
 * PHP version 5.4.2
 *
 * @link https://github.com/nimblepayments/sdk-php
 * @filesource
 */

require_once(__DIR__.'/../base/NimbleAPIConfig.php');

/**
 * Class responsible for performing payments services.
 */
class NimbleAPIPayments
{

    /**
     * Method sendPaymentClient
     *
     * @param object $NimbleApi
     * @param array $context
     * @return array
     */
    public static function sendPaymentClient($NimbleApi, $context)
    {
        
        if (empty($NimbleApi)) {
            throw new Exception('$NimbleApi parameter is empty.');
        }
        if (empty($context)) {
            throw new Exception('$payment parameter is empty, please enter a payment');
        }
    
        try {
            $NimbleApi->setPostfields(json_encode($context));
            $NimbleApi->uri = 'payments';
            $NimbleApi->method = 'POST';
            $response = $NimbleApi->restApiCall();
            return $response;
        } catch (Exception $e) {
            throw new Exception('Error in sendPaymentClient: ' . $e);
        }
    }

    /**
     * Method ExecutePaymentClient
     *
     * @param object $NimbleApi
     * @return unknown
     */
    public static function findPaymentClient($NimbleApi, $IdPayment)
    {
        if (empty($NimbleApi) || empty($IdPayment)) {
            throw new Exception('$NimbleApi parameter is empty.');
        }
        try {
            $NimbleApi->uri .= 'payments/'.$IdPayment;
            $NimbleApi->method = 'GET';
            $response = $NimbleApi->restApiCall();
            return $response;
        } catch (Exception $e) {
            throw new Exception('Error in ExecutePaymentClient: ' . $e);
        }
    }
}
