<?php
/**
 * Nimble-API-PHP : API v1.2
 *
 * PHP version 5.4.2
 *
 * @link https://github.com/nimblepayments/sdk-php
 * @filesource
 */

require_once 'NimbleAPIConfig.php';
require_once 'NimbleAPIAuthorization.php';
require_once '../lib/Nimble/api/NimbleAPIAuth.php';


/**
 * NimbleAPI is the api that does all the connection mechanism to each of the requests. It is primarily responsible for
 * handling each.
 */
class NimbleAPI
{

    /**
     * @source
     *
     * @var string $ uri. (Url service api rest)
     */
    public $base_uri;

    /**
     * @source
     *
     * @var string $ uri. (Url service api rest)
     */
    public $uri;

    /**
     * @source
     *
     * @var string $ uri. (Url service oauth)
     */
    public $uri_oauth;

    /**
     *
     * @var string $ method. (Could be 'GET, POST PATH, DELETE, PUT')
     */
    public $method;

    /**
     *
     * @var array $ postfields. (Attribute Manager contain the post parameters if necessary)
     */
    private $postfields;

    /**
     *
     * @var string $ getfields. (Attribute Manager contain the get parameters if necessary)
     */
    private $getfields;

    /**
     *
     * @var Object $ authorization. (An object that contains the definition of authorization)
     */
    public $authorization;

    /**
     *
     * @var string $ laststatuscode (contain the last code for the last request: 401, 200, 500)
     */
    protected $laststatuscode;

    /**
     * 
     * @var bool $ use_curl (if need curl_lib to work)
     */
    protected $use_curl = true;

    /**
     * Construct method. Start the object NimbleApi. Start the Object NimbleAPIAuthorization too.
     *
     * @param array $settings. (must contain at least clientId and clientSecret vars)
     * @throws Exception. (Return exception if not exist clientId or clientSecret)
     */
    public function __construct(array $settings)
    {
        if ( $this->use_curl && ! in_array('curl', get_loaded_extensions())) {
            throw new Exception('You need to install cURL, see: http://curl.haxx.se/docs/install.html');
        }
        
        if (empty($settings['clientId'])) {
            throw new Exception('secretKey or clientId cannot be null or empty!');
        }
        if (empty($settings['clientSecret'])) {
            if ($settings['requestCode']) {
                // Performance redirect
                $this->authorization = new NimbleAPIAuthorization();
                $this->authorization->requestCode($settings['clientId']);
                die();
            } else {
                throw new Exception('secretKey or clientId cannot be null or empty!');
            }
        }

        if (empty($settings['mode'])) {
            throw new Exception('mode cannot be null or empty!');
        }
        try {
            // Set URL depending on environment
            if ($settings['mode'] == 'real') {
                $this->uri = NimbleAPIConfig::NIMBLE_API_BASE_URL;
                $this->base_uri = NimbleAPIConfig::NIMBLE_API_BASE_URL;
            } else {
                $this->uri = NimbleAPIConfig::NIMBLE_API_BASE_URL_DEMO;
                $this->base_uri = NimbleAPIConfig::NIMBLE_API_BASE_URL_DEMO;
            }

            // Authenticate object
            $this->authorization = new NimbleAPIAuthorization();
            // Set auth type (basic or 3legger)
            $this->authorization->setAuthType(isset($settings['authType'])?$settings['authType']:'basic');
            // Set credentials
            $this->authorization->setClientId($settings['clientId']);
            $this->authorization->setClientSecret($settings['clientSecret']);
            // Check if we are on oAuth process by parameter oauth_code
            if (isset($settings['oauth_code'])) {
                //HEADERS
                $this->authorization->addHeader('Content-Type', 'application/json');
                $this->authorization->addHeader('Accept', 'application/json');
                
                // oAuth process > needs to request token to security server (with oauth_code)
                NimbleAPIAuth::getCodeAuthorization($this, $settings['oauth_code']);
            } elseif (! $this->authorization->isAccessParams()) {
                // Not oAuth process > check if token is provided
                if (isset($settings['token'])) {
                    // Already authenticated > save data
                    $this->authorization->setAccessParams(array(
                        'token_type' => 'tsec',
                        'access_token' => $settings['token'],
                        ));
                    // If refresh token provided perform refresh callback
                    if (isset($settings['refreshToken'])) {
                        $this->uri_oauth = NimbleAPIConfig::OAUTH_URL;
                        $this->authorization->setRefreshToken($settings['refreshToken']);
                        NimbleAPIAuth::refreshToken($this);
                    }
                } else {
                    //HEADERS
                    $this->authorization->addHeader('Content-Type', 'application/json');
                    $this->authorization->addHeader('Accept', 'application/json');
                    // Not yet authenticated
                    NimbleAPIAuth::getPaymentAuthorization($this);
                }
            }
        } catch (Exception $e) {
            throw new Exception('Failed to instantiate NimbleAPIAuthorization: ' . $e);
        }
    }

    /**
     * Method responsible for making Rest API calls @ Return $response from rest api.
     *
     * @return $response
     */
    public function restApiCall()
    {
        try {
            if (! isset($curl_connect)) {
                $curl_connect = curl_init();
            }
            
            $header = $this->getHeaders();
            //Prepare header
            $curl_header = array();
            foreach ($header as $param => $value) {
                if ($value != "") {
                    array_push($curl_header, $param . ': ' . $value);
                }
            }
            
            $postfields = $this->getPostfields();
            
            $url = $this->getApiUrl();

            $options = array(
                    CURLOPT_HTTPHEADER => $curl_header,
                    CURLOPT_URL => $url,
                    CURLOPT_CUSTOMREQUEST => $this->method, // GET POST PUT PATCH DELETE
                    CURLOPT_HEADER => false,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => NimbleAPIConfig::TIMEOUT
            );

            if (! is_null($postfields)) {
                $options[CURLOPT_POSTFIELDS] = $postfields;
            }
            
            curl_setopt_array($curl_connect, ($options));

            //SSL PROBLEMS
            curl_setopt($curl_connect, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl_connect, CURLOPT_SSL_VERIFYHOST, false);
            
            $response = json_decode(curl_exec($curl_connect), true);

            $this->setLastStatusCode(curl_getinfo($curl_connect, CURLINFO_HTTP_CODE));
            
            curl_close($curl_connect);
            return $response;
        } catch (Exception $e) {
            throw new Exception('Failed to send Data in restApiCall: ' . $e);
        }
    }

    /**
     * Method setGetfields example: '?grant_type=client_credentials&scope=read'
     *
     * @param string $getfields
     * @return NimbleAPI
     */
    public function setGetfields($getfields)
    {
        $this->postfields = null;
        
        $search = array(
                '#',
                ',',
                '+',
                ':'
        );
        $replace = array(
                '%23',
                '%2C',
                '%2B',
                '%3A'
        );
        $getfields = str_replace($search, $replace, $getfields);
        
        $this->getfields = $getfields;
        
        return $this;
    }

    /**
     * Method getUri
     *
     * @return string $uri
     */
    public function getUri()
    {
        return $this->uri;
    }
    /**
     * Method setUri
     *
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * Method setPostfields
     *
     * @param string $postfields
     */
    public function setPostfields($postfields)
    {
        //$this->getfields = null;
        $this->postfields = $postfields;
        
        return $this;
    }

    /**
     * Method getGetfields
     *
     * @return string
     */
    public function getGetfields()
    {
        return $this->getfields;
    }

    /**
     * Method getPostfields
     *
     */
    public function getPostfields()
    {
        return $this->postfields;
    }

    /**
     * Method getLastStatusCode.
     *
     *
     * @return string. Return the last status code 401 UnAuthorized, 200 Accept.
     */
    public function getLastStatusCode()
    {
        return $this->laststatuscode;
    }

    /**
     * Method setLastStatusCode
     *
     * @param unknown $code
     * @return NimbleAPI object
     */
    public function setLastStatusCode($code)
    {
        $this->laststatuscode = $code;
        return $this;
    }

    /**
     * Method clear. Clear all attributes of class NimbleApi except Object(for example: authorization)
     */
    public function clear()
    {
        try {
            foreach ($this as $key => &$valor) {
                eval('$isArray=is_array($this->' . $key . ');');
                eval('$isObject=is_object($this->' . $key . ');');
                if (! $isObject) {
                    if ($isArray) {
                        eval('$this->' . $key . '=array();');
                    } else {
                        eval('$this->' . $key . '=null;');
                    }
                }
            }
        } catch (Exception $e) {
            throw new Exception('Failed to clear attrubutes: ' . $e);
        }
    }
    
    /**
     * Method getHeaders
     * @return array. Returns the header to the api rest call
     */
    public function getHeaders ()
    {
        $this->authorization->buildAccessHeader();
        $header = $this->authorization->getHeader();
        return $header;
    }
    
    /**
     * Methos getApiUrl
     * @return string. Return the url to the api rest call
     */
    function getApiUrl(){
        
        if (!empty($this->uri_oauth)) {
            $url = $this->uri_oauth;
            $this->uri_oauth = "";
        } else {
            $url = $this->base_uri . $this->uri;
        }
        
        //Set GET params
        if ( $this->getfields ){
            $getfields = $this->getGetfields();
            if ($getfields !== '') {
                $url .= $getfields;
            }
        }
        
       return $url;
    }
    
    /**
     * Validates mode corresponds with credentials
     * @return type
     */
    public function checkMode(){
        $this->setUri('check');
        $this->method = 'GET';
        $response = $this->restApiCall();
        return $response;
    }

    
    /*
     * Get the URL for Authentication on 3 steps
     */
    public function getOauth3Url(){
        return $this->authorization->getOauth3Url();
    }
    
    static public function getGatewayUrl($platform, $storeName, $storeURL, $redirectURL) {
        $params = array(
            'action' => 'gateway',
            'mode' => NimbleAPIConfig::MODE,
            'platform' => $platform,
            'storeName' => $storeName,
            'storeURL' => rtrim(strtr(base64_encode($storeURL), '+/', '-_'), '='),
            'redirectURL' => rtrim(strtr(base64_encode($redirectURL), '+/', '-_'), '=')
            
        );
        
        return NimbleAPIConfig::GATEWAY_URL.'?'.http_build_query($params);
        
    }
}
