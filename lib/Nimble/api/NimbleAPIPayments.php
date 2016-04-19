<?php

/**
 * Nimble-API-PHP : API v1.2
 *
 * PHP version 5.4.2
 *
 * @link https://github.com/nimblepayments/sdk-php
 * @filesource
 */
require_once(__DIR__ . '/../base/NimbleAPIConfig.php');

/**
 * Class responsible for performing payments services.
 */
class NimbleAPIPayments {

    /**
     * Method sendPaymentClient
     *
     * @param object $NimbleApi
     * @param array $context
     * @return array
     */
    public static function sendPaymentClient($NimbleApi, $context) {

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
     * Method updateCustomerData
     *
     * @param object $NimbleApi
     * @param array $transaction_id
     * @param array $new_order_id
     * @return array
     */
    public static function updateCustomerData($NimbleApi, $transaction_id, $new_order_id) {


        if (empty($NimbleApi)) {
            throw new Exception('$NimbleApi parameter is empty.');
        }
        if (empty($transaction_id)) {
            throw new Exception('$payment parameter is empty, please enter a payment');
        }

        try {
            $aux_order = array('customerData' => $new_order_id);
            $NimbleApi->setPostfields(json_encode($aux_order));
            $NimbleApi->uri = 'payments/' . $transaction_id;
            $NimbleApi->method = 'PUT';
            $response = $NimbleApi->restApiCall();
            return $response;
        } catch (Exception $e) {
            throw new Exception('Error in updateCustomerData: ' . $e);
        }
    }

}
