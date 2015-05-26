<?php // This file is only for show the code in the screen, through the scripts placed in test folder ?>

Authentication:
---------------
<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
use Nimble\Base\NimbleAPI;

$params = array(
        'clientId' => 'REPLACEME_DEMO_CLIENT_SECRET',
        'clientSecret' => 'REPLACEME_DEMO_CLIENT_SECRET',
        'mode' => 'demo'
);

/**
 * High & Low level call.
 *
 * @param PATH_TO_SDK, Base\Config\CLIENT_ID and Base\Config\CLIENT_SECRET must be changed credential values on
 *            client/base/Config.php.
 */

$NimbleApi = new NimbleAPI($params);

?>