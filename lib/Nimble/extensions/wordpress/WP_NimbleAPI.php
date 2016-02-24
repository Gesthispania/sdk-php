<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Description of WP_NimbleAPI
 *
 * @author acasado
 */
class WP_NimbleAPI extends NimbleAPI{
    
    /**
     * 
     * @var bool $ use_curl (if need curl_lib to work)
     */
    protected $use_curl = false;
    
    /**
     * Method responsible for making Rest API calls @ Return $response from rest api.
     *
     * @return $response
     */
    public function rest_api_call ()
    {
        try {
            	
            if( !class_exists( 'WP_Http' ) )
                include_once( ABSPATH . WPINC. '/class-http.php' );
            $request = new WP_Http;

            $postfields = $this->getPostfields();
            $header = $this->getHeaders();
            $url = $this->getApiUrl();
            
            $options = array(
                    'headers' => $header,
                    'method' => $this->method, // GET POST PUT PATCH DELETE
                    //CURLOPT_HEADER => false,
                    //CURLOPT_RETURNTRANSFER => true,
                    'timeout' => ConfigSDK::TIMEOUT
            );
            

            if (! is_null($postfields)) {
                $options['body'] = $postfields;
            }
            
            //SSL PROBLEMS
            $options['sslverify'] = false;
            
            $result = $request->request( $url, $options );
            if (!is_wp_error($result)){
                $json = $result['body'];

                $response = json_decode($json, true);

                $response_status = $result['response']['code'];

                $this->setLastStatusCode($response_status);
            } else {
                $this->setLastStatusCode(0);
            }
            $this->getLastStatusCode() == 200 ? $this->setAttemps(0) : $this->attemps ++;
            
            // getLastStatusCode() return 0 in timeout
            if (($this->getLastStatusCode() == 401 or $this->getLastStatusCode() == 403 or $this->getLastStatusCode() == 0)  and
                $this->getAttemps() <= $this->max_attemps) {
                $response = $this->rest_api_call();
            }

            $this->setAttemps(0);
            if ($this->authorization->is_preauthorized_request) {
                $this->authorization->setAccessParams($response);
            }
            
            return $response;
        }
        catch (Exception $e) {
            throw new Exception('Failed to send Data in rest_api_call: ' . $e);
        }
    }
}
