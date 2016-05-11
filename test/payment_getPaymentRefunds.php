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
<h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret<br />
1.- Called to contructor: NimbleAPI(Array);<br />
2.- Called to NimbleAPIPayments::getPaymentRefunds($NimbleApi, $transaction_id, $amount);</h3>
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
if ( isset($_REQUEST['transaction_id']) && isset($_SESSION['access_token']) ):
    /* High Level call */
    $transaction_id = $_REQUEST['transaction_id'];
    $params['token'] = $_SESSION["access_token"];
    $NimbleApi = new NimbleAPI($params);
    $response2 = NimbleAPIPayments::getPaymentRefunds($NimbleApi, $transaction_id);
    var_dump($response2);
endif;
?>
</pre>