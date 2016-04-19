<?php
//show code
//highlight_file("/info/authentication.php");
?>
<br />
<form action="#"><label>CODE</label><input type="text" name="code"/><input type="submit" value="validate"/></form>
<br/>
<a href="https://www.nimblepayments.com/auth/connect?client_id=BD418DCC1C271E2889EBEF9AA78C561D&response_type=code">Get code here</a>
------------------------------------------------------------------------------------------------------------
<br />
<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once 'functions.php';

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET,
        'mode' => NimbleAPIConfig::MODE
);


if ($_REQUEST['code']):
    $params['oauth_code'] = $_REQUEST['code'];
    $NimbleApi = new NimbleAPI($params);
    ?>
    <br /> <pre>
    Response:
    <?php
    var_dump($NimbleApi->authorization->getAccessToken());
    var_dump($NimbleApi->authorization->getRefreshToken());
    
    $params = array(
            'clientId' => CLIENT_ID,
            'clientSecret' => CLIENT_SECRET,
            'mode' => NimbleAPIConfig::MODE,
            'token' => 'old_token',
            'refreshToken' => $NimbleApi->authorization->getRefreshToken()
    );
    $NimbleApi2 = new NimbleAPI($params);
    
    //$response2 = NimbleAPIAuth::refreshToken($NimbleApi2);
    ?>
    <hr>
    Response:
    <?php
    var_dump($NimbleApi2->authorization->getAccessToken());
    var_dump($NimbleApi2->authorization->getRefreshToken());
    
endif;

?>