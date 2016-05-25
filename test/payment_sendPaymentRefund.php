<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once '../lib/Nimble/api/NimbleAPIPayments.php';
require_once 'functions.php';

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);

?>
<hr />
<br />
<h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret, token<br />
1.- Called to contructor: NimbleAPI(Array);<br />
2.- Called to NimbleAPIPayments::sendPaymentRefund($NimbleApi, $transaction_id, $amount);</h3>
<br />
<form action="#">
    <label title="Get from payment_send.php test">TRANSACTION_ID: <input type="text" name="transaction_id"/></label> <br/><br/>
    <!--<label title="Get from authentication_code.php test">BASE64 TOKEN OAUTH3: <br/><textarea rows="6" cols="100" type="text" name="token"></textarea></label> <br/>-->
    <br/>
    <input type="submit" value="validate"/>
</form>
<br />
<pre>
<?php
if( isset($_SESSION['otp_token']) && isset($_SESSION['info_refund']) && isset($_REQUEST['ticket']) && isset($_REQUEST['result']) && $_REQUEST['result'] == 'OK' ){
    //RECOVERY INFO REFUND
    $info_refund = unserialize($_SESSION["info_refund"]);
    //RECOVERY OTP TOKEN
    $params['token'] = $_SESSION['otp_token'];
    $NimbleApi = new NimbleAPI($params);
    $response = NimbleAPIPayments::sendPaymentRefund($NimbleApi, $info_refund['transaction_id'], $info_refund['amount']);
    var_dump($response);
}else if ( isset($_REQUEST['transaction_id']) && isset($_SESSION['access_token']) ){
    /* High Level call */
    $amount = array ("amount" => 300,
                     "concept"=> "Shoes",
                     "reason" => "REQUEST_BY_CUSTOMER");

    $transaction_id = $_REQUEST['transaction_id'];
    $params['token'] = $_SESSION['access_token'];
    $NimbleApi = new NimbleAPI($params);
    $response = NimbleAPIPayments::sendPaymentRefund($NimbleApi, $transaction_id, $amount);
    var_dump($response);
    
    //BACK URL
    $pre_url = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
    $back_url = $pre_url . $_SERVER['SERVER_NAME'] . $_SERVER['PATH_INFO'];
    var_dump($back_url);
    //TICKET
    $ticket = $response['data']['ticket'];
    //TOKEN OTP
    $_SESSION["otp_token"] = $response['data']['token'];
    //REFUND INFO
    $info_refund = array(
        'amount' => $amount,
        'transaction_id' => $transaction_id
    );
    $_SESSION["info_refund"] = serialize($info_refund);
    
    
    $url_otp = NimbleAPI::getOTPUrl($ticket, $back_url);
    echo "<a href='{$url_otp}'>LINK OTP</a>";
    
}
?>
</pre>