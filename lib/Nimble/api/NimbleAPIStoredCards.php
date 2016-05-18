<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'NimbleAPIPayments.php';

/**
 * Description of NimbleAPIStoredCards
 *
 * @author acasado
 */
class NimbleAPIStoredCards {
    
    /*
     * Get all stored customer cards
     */
    public static function getStoredCards($NimbleApi, $cardHolderId){
        
        if (empty($NimbleApi)) {
            throw new Exception('$NimbleApi parameter is empty.');
        }
        if (empty($cardHolderId)) {
            throw new Exception('$cardHolderId parameter is empty, please enter a cardHolderId');
        }

        try {
            //HEADERS
            //$this->authorization->buildAuthorizationHeader('tsec');
            $NimbleApi->authorization->addHeader('Content-Type', 'application/json');
            $NimbleApi->authorization->addHeader('Accept', 'application/json');
            
            $NimbleApi->uri = 'payments/storedCards/cardHolders/' . $cardHolderId;
            $NimbleApi->method = 'GET';
            $response = $NimbleApi->restApiCall();
            return $response;
        } catch (Exception $e) {
            throw new Exception('Error in getStoredCards: ' . $e);
        }
    }
    
    /*
     * Change default customer stored card
     */
    public static function selectDefault($NimbleApi, $cardInfo){
        
        if (empty($NimbleApi)) {
            throw new Exception('$NimbleApi parameter is empty.');
        }
        if (empty($cardInfo)) {
            throw new Exception('$cardInfo parameter is empty, please enter a cardInfo');
        }

        try {
            //HEADERS
            //$this->authorization->buildAuthorizationHeader('tsec');
            $NimbleApi->authorization->addHeader('Content-Type', 'application/json');
            $NimbleApi->authorization->addHeader('Accept', 'application/json');
            
            $NimbleApi->setPostfields(json_encode($cardInfo));
            $NimbleApi->uri = 'payments/storedCards/default';
            $NimbleApi->method = 'POST';
            $response = $NimbleApi->restApiCall();
            return $response;
        } catch (Exception $e) {
            throw new Exception('Error in selectDefault: ' . $e);
        }
    }
    
    /*
     * Delete a customer stored card
     */
    public static function deleteCard($NimbleApi, $cardInfo){
        
        if (empty($NimbleApi)) {
            throw new Exception('$NimbleApi parameter is empty.');
        }
        if (empty($cardInfo)) {
            throw new Exception('$cardInfo parameter is empty, please enter a cardInfo');
        }

        try {
            //HEADERS
            //$this->authorization->buildAuthorizationHeader('tsec');
            $NimbleApi->authorization->addHeader('Content-Type', 'application/json');
            $NimbleApi->authorization->addHeader('Accept', 'application/json');
            
            $NimbleApi->setPostfields(json_encode($cardInfo));
            $NimbleApi->uri = 'payments/storedCards';
            $NimbleApi->method = 'DELETE';
            $response = $NimbleApi->restApiCall();
            return $response;
        } catch (Exception $e) {
            throw new Exception('Error in deleteCard: ' . $e);
        }
    }
    
    /*
     * Make payment for a customer with default stored card
     */
    public static function payment($NimbleApi, $storedCardPaymentInfo){
        
        if (empty($NimbleApi)) {
            throw new Exception('$NimbleApi parameter is empty.');
        }
        if (empty($storedCardPaymentInfo)) {
            throw new Exception('$storedCardPaymentInfo parameter is empty, please enter a storedCardPaymentInfo');
        }

        try {
            //HEADERS
            //$this->authorization->buildAuthorizationHeader('tsec');
            $NimbleApi->authorization->addHeader('Content-Type', 'application/json');
            $NimbleApi->authorization->addHeader('Accept', 'application/json');
            
            $NimbleApi->setPostfields(json_encode($storedCardPaymentInfo));
            $NimbleApi->uri = 'payments/storedCards';
            $NimbleApi->method = 'POST';
            $response = $NimbleApi->restApiCall();
            
            //If Timeout Error return info of last transaction with the same merchantOrderId
            if (is_null($response)){
                $response = NimbleAPIPayments::getPaymentStatus($NimbleApi, null, $storedCardPaymentInfo['merchantOrderId']);
                if ( isset($response['data']) && isset($response['data']['details']) && count($response['data']['details']) ){
                    $last_pos = 0;
                    $payment_detail = $response['data']['details'][$last_pos];
                    $response['data']['id'] = $payment_detail['transactionId'];
                    //error_log(print_r($payment_detail, true));
                    unset($response['data']['details']);
                }
            }
            return $response;
        } catch (Exception $e) {
            throw new Exception('Error in payment: ' . $e);
        }
    }
}
