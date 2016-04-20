<?php
//show code
//highlight_file("/info/authentication.php");
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once 'functions.php';

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);
$NimbleApi = new NimbleAPI($params);
?>
<br />
<form action="#"><label>CODE</label><input type="text" name="code"/><input type="submit" value="validate"/></form>
<br/>

<a href="<?php echo $NimbleApi->getOauth3Url();?>">Get code here</a>
------------------------------------------------------------------------------------------------------------
<br />
<?php

if (isset($_REQUEST['code'])):
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
            'token' => 'old_token',
            'refreshToken' => $NimbleApi->authorization->getRefreshToken()
    );
    $NimbleApi2 = new NimbleAPI($params);
    
    //$response2 = NimbleAPIAuth::refreshToken($NimbleApi2);
    ?>
    Response:
    <?php
    var_dump($NimbleApi2->authorization->getAccessToken());
    var_dump($NimbleApi2->authorization->getRefreshToken());
    ?>
    <hr>
    BASE64 OAUTH3 TOKEN: <?php echo base64_encode($NimbleApi2->authorization->getAccessToken()); ?>
    <?php
endif;

?>