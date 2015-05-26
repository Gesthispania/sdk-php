<?php
/**  
 * Nimble-API-PHP : API v1.0
 *
 * PHP version 5.4.3
 *
 * @namespace Base\Config
 * @link http://github.com/...
 * @filesource
 */
namespace Nimble\Base;

/**
 * Class Config
 * Placeholder for Nimble Config
 *
 * @package Base\Core
 */
class Config
{

    const SDK_NAME = 'Nimble-PHP-SDK';
    const SDK_VERSION = '1.0';

    /**
	 *
	 * @var string OAUTH_URL constant var, with the base url to connect with Oauth
	 */
	const OAUTH_URL = "https://dev.nimblepayments.com/auth/tsec/token";

	/**
	 *
	 * @var string NIMBLE_API_BASE_URLs constant var, with the base url of live enviroment to make requests
	 */
	//const NIMBLE_API_BASE_URL = "http://52.17.74.56:8080/nimble-mock/rest/";
	const NIMBLE_API_BASE_URL = "https://dev.nimblepayments.com/api/";

    /**
	 *
	 * @var string NIMBLE_API_BASE_URLs constant var, with the base url of demo enviroment to make requests
	 */
    //const NIMBLE_API_BASE_URL_DEMO = "http://52.17.74.56:8080/nimble-mock/rest/";
    const NIMBLE_API_BASE_URL_DEMO = "https://dev.nimblepayments.com/sandbox-api/";

    /**
	 *
	 * @var int MAX_ATTEMPS constant var
	 */
    const MAX_ATTEMPS = 3;

    /**
	 *
	 * @var int TIMEOUT (seconds) constant var
	 */
    const TIMEOUT = 10;
}