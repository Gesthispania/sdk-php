<?php
require_once '../lib/Nimble/api/NimbleAPIAccount.php';
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once 'functions.php';


$transfer = array(
    'amount' => array(
        'value' => 1,
        'currency' => 'EUR'
    ),
    'concept' => 'Cash Out Sample'
);

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);
/* High Level call */

?>
<hr />
<br />
<h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret, token */<br />
1.- Called to contructor: NimbleAPI(Array);<br />
2.- Called to NimbleAPIAccount::cashOut($NimbleApi, $transfer);</h3>
 
    <!--<br />
    <form action="#">
        <label title="Get from authentication_code.php test">BASE64 TOKEN OAUTH3: <br/><textarea rows="6" cols="100" type="text" name="token"></textarea></label> <br/>
        <br/>
        <input type="submit" value="validate"/>
    </form>
    <br />-->

<pre>    
<?php
if( isset($_SESSION['otp_token']) && isset($_REQUEST['ticket']) && isset($_REQUEST['result']) && $_REQUEST['result'] == 'OK' ){
    $params['token'] = $_SESSION['otp_token'];
    $NimbleApi = new NimbleAPI($params);
    $response = NimbleAPIAccount::cashOut($NimbleApi, $transfer);
    var_dump($response);
}else if(isset($_SESSION['access_token'])){
    $params['token'] = $_SESSION['access_token'];
    $NimbleApi = new NimbleAPI($params);
    $response = NimbleAPIAccount::cashOut($NimbleApi, $transfer);
    var_dump($response);
    
    //BACK URL
    $pre_url = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
    $back_url = $pre_url . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    //TICKET
    $ticket = $response['data']['ticket'];
    //TOKEN OTP
    $_SESSION["otp_token"] = $response['data']['token'];
    
    $url_otp = NimbleAPI::getOTPUrl($ticket, $back_url);
    echo "<a href='{$url_otp}'>LINK OTP</a>";
}
    
?>
</pre>