<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
        //TODO
        //method GET
    }
    
    /*
     * Change default customer stored card
     */
    public static function selectDefault($NimbleApi, $cardInfo){
        //TODO
        //method POST
    }
    
    /*
     * Delete a customer stored card
     */
    public static function deleteCard($NimbleApi, $cardInfo){
        //TODO
        //method DEL
    }
    
    /*
     * Make payment for a customer with default stored card
     */
    public static function payment($NimbleApi, $storedCardPaymentInfo){
        //TODO
        //method POST
    }
}
