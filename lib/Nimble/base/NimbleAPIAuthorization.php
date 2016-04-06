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

/**
 * Implements the Authorization header of the request to perform the identification correctly according to the type of
 * request
 */
class NimbleAPIAuthorization
{
    /**
     *
     * @var string $ clientId
     */
    private $clientId;

    /**
     *
     * @var string $ clientSecret
     */
    private $clientSecret;

    /**
     *
     * @var string $ token_type
     */
    private $token_type;

    /**
     *
     * @var string $ access_token
     */
    private $access_token;

    /**
     *
     * @var string $ refresh_token
     */
    private $refresh_token;

    /**
     *
     * @var string $ is_authorized_request
     */
    public $is_preauthorized_request;

    /**
     *
     * @var int. $ expires_in. Time in seconds for the token ceases to be valid
     */
    private $expires_in;

    /**
     *
     * @var int. $ refresh_expires_in. Time in seconds for the refresh token ceases to be valid
     */
    private $refresh_expires_in;

    /**
     *
     * @var string
     */
    private $scope;

    /**
     *
     * @var string. Basic or 3legged
     */
    private $authType;

    /**
     * Function addheader, add a type param with a context in the header
     *
     * @param string $param
     * @param string $content
     */
    public function addHeader($param, $content)
    {
        $this->header[$param] = $content;
    }

    /**
     * Method deleteheader, add a type param with a context in the header
     *
     * @param string $param
     */
    public function deleteHeader($param)
    {
        unset($this->header[$param]);
    }

    /**
     * Method buildAuthorizationHeader, add Authorization header.
     */
    public function buildAuthorizationHeader()
    {
        $this->addHeader('Authorization', 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret));
        $this->is_preauthorized_request = 1;
    }

    /**
     * Method buildAccessHeader, add Access Authorization header.
     *
     * @throws Exception
     */
    public function buildAccessHeader()
    {
        $this->is_preauthorized_request = 0;
        if ($this->isAccessParams()) {
            $this->addHeader('Authorization', $this->token_type . ' ' . $this->access_token);
        }

    }

    /**
     * Method setAccessParams, set token_type and access_token
     *
     * @param string $response
     */
    public function setAccessParams($response)
    {
        if ((isset($response['token_type'])) && (isset($response['access_token']))) {
            $this->token_type = $response['token_type'];
            $this->access_token = $response['access_token'];
        } else {
            throw new Exception('The identification was incorrect, check clientId and clientSecret');
        }
        
        if ((isset($response['expires_in'])) && (isset($response['scope']))) {
            $this->expires_in = time() + (int)$response['expires_in'];
            $this->scope = $response['scope'];
        }
        if (isset($response['refresh_token']) && isset($response['refresh_expires_in'])) {
            $this->refresh_token = $response['refresh_token'];
            $this->refresh_expires_in = $response['refresh_expires_in'];
        }
    }

    /**
     * Method isAccessParams, return TRUE if exist the params.
     *
     * @return boolean
     */
    public function isAccessParams()
    {
        if (($this->token_type != null) && ($this->access_token != null)) {
            return true;
        }
        return false;
    }

    /**
     * Method buildHeader. Returns an array of header parameters.
     *
     * @return multitype:
     */
    public function buildHeader()
    {
        $header = array();
        foreach ($this->header as $param => $value) {
            if ($value != "") {
                array_push($header, $param . ': ' . $value);
            }
        }
        return $header;
    }
    
    /**
     * Method getHeader. Returns an array of header parameters.
     *
     * @return multitype:
     */
    public function getHeader ()
    {
        return $this->header;
    }

    /**
     * Method getExpirationTime
     *
     * @return string
     */
    public function getExpirationTime()
    {
        return $this->expires_in;
    }
    /**
     * Method getRefreshExpirationTime
     *
     * @return string
     */
    public function getRefreshExpirationTime()
    {
        return $this->refresh_expires_in;
    }
    /**
     * Method getAuthType
     *
     * @return string
     */
    public function getAuthType()
    {
        return $this->authType;
    }

    /**
     * Method setAuthType
     *
     * @param string $authType
     */
    public function setAuthType($authType)
    {
        $this->authType = $authType;
    }

    /**
     * Method getClientId
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Method setClientId
     *
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * Method getClientSecret
     *
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * Method setClientSecret
     *
     * @param string $clientSecret
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * Method getAccessToken
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * Method setAccessToken
     *
     * @param string $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * Method getRefreshToken
     *
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    /**
     * Method setRefreshToken
     *
     * @param string $refresh_token
     */
    public function setRefreshToken($refresh_token)
    {
        $this->refresh_token = $refresh_token;
    }

    /**
     * Method getTokenType
     *
     * @return string
     */
    public function getTokenType()
    {
        return $this->access_token;
    }

    /**
     * Method setTokenType
     *
     * @param string $token_type
     */
    public function setTokenType($token_type)
    {
        $this->token_type = $token_type;
    }

    /**
     * Refresh token callback implementation
     * @param  object $NimbleApi NimbleAPI object
     * @return boolean            wether the refresh operation was succesfully executed or not
     */
    public function refreshToken($NimbleApi)
    {
        if (empty($NimbleApi)) {
            throw new Exception('$NimbleApi parameter is empty');
        }
        try {
            $NimbleApi->uri_oauth = NimbleAPIConfig::OAUTH_URL;
            $NimbleApi->setGetfields('?grant_type=refresh_token');
            $postfields = array(
                            'refresh_token' => $this->refresh_token
                        );
            $NimbleApi->setPostfields(http_build_query($postfields));
          
            $NimbleApi->method = 'POST';
            $this->buildAuthorizationHeader();
            $this->access_token = null;
            $response = $NimbleApi->restApiCall();

            $NimbleApi->setGetfields(null);

            if (isset($response['result']) && $response['result']['code'] != "200") {
                switch ($response['result']['code']) {
                    case '401':
                        // Refresh token expired ?
                        break;
                    default:
                        throw new Exception($response['result']['code'].' '.$response['result']['info']);
                }
                
            } else {
                $this->setAccessParams($response);
            }

            return true;
        } catch (Exception $e) {
            throw new Exception('Failed in refreshToken: ' . $e);
        }
    }

    /**
     * Implements first step of oAuth process, redirecting request to security server
     * @param  string $clientId client id
     */
    public function requestCode($clientId)
    {
        $params = array(
            'response_type' => 'code',
            'client_id' => $clientId
        );
        try {
            header("Location: " . NimbleAPIConfig::OAUTH3_URL_AUTH.'?'.http_build_query($params));
            die();
        } catch (Exception $e) {
            throw new Exception('Failed in requestCode: ' . $e);
        }
    }

    /**
     * Implements authorization process on NimbleAPI object (basic or 3legged)
     * @param  object $NimbleApi NimbleAPI object to authorize
     * @return boolean           wether or not was authorized
     */
    public function getAuthorization($NimbleApi)
    {
        if (empty($NimbleApi)) {
            throw new Exception('$NimbleApi parameter is empty');
        }
        try {
            $NimbleApi->uri_oauth = NimbleAPIConfig::OAUTH_URL;
            switch ($this->getAuthType()) {
                case 'basic':
                    $NimbleApi->setGetfields('?grant_type=client_credentials&scope=PAYMENT');
                    break;
                case '3legged':
                    $NimbleApi->setGetfields('?grant_type=authorization_code&code=' . $NimbleApi->oauth_code);
                    break;
            }
            $NimbleApi->method = 'POST';
            $this->buildAuthorizationHeader();
            $response = $NimbleApi->restApiCall();

            $NimbleApi->setGetfields(null);

            if (isset($response['result']) && $response['result']['code'] != "200") {
                switch ($response['result']['code']) {
                    case '401':
                        // Try to refresh token
                        break;
                    default:
                        throw new Exception($response['result']['code'].' '.$response['result']['info']);
                }
                
            } else {
                $this->setAccessParams($response);
            }

            return true;
        } catch (Exception $e) {
            throw new Exception('Failed in getAuthorization: ' . $e);
        }
    }
    
    /*
     * Get the URL for Authentication on 3 steps
     */
    public function getOauth3Url()
    {
        $params = array(
            'response_type' => 'code',
            'client_id' => $this->clientId
        );
        return NimbleAPIConfig::OAUTH3_URL_AUTH.'?'.http_build_query($params);
    }
}
