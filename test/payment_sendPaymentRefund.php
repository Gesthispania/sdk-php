<?php
//show code
//highlight_file("/info/payment_send.php");
?>
<br />
------------------------------------------------------------------------------------------------------------
<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once '../lib/Nimble/api/NimbleAPIPayments.php';
require_once 'functions.php';

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);

?>
------------------------------------------------------------------------------------------------------------

<br />
<form action="#">
    <label title="Get from payment_send.php test">TRANSACTION_ID <input type="text" name="transaction_id"/></label> <br/>
    <label title="Get from authentication_code.php test">BASE64 TOKEN OAUTH3 <textarea type="text" name="token"></textarea></label> <br/>
    <input type="submit" value="validate"/>
</form>
<br/>
------------------------------------------------------------------------------------------------------------
<br /> <pre>

<?php
if ( isset($_REQUEST['transaction_id']) && isset($_REQUEST['token']) ):
    /* High Level call */
    $amount = array ("amount" => 300,
                     "concept"=> "Shoes",
                     "reason" => "REQUEST_BY_CUSTOMER");

    $transaction_id = $_REQUEST['transaction_id'];
    $params['token'] = base64_decode($_REQUEST['token']);
    $NimbleApi = new NimbleAPI($params);
    $response2 = NimbleAPIPayments::sendPaymentRefund($NimbleApi, $transaction_id, $amount);
    var_dump($response2);
endif;
?>