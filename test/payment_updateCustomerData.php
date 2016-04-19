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
<form action="#"><label>TRANSACTION_ID</label><input type="text" name="transaction_id"/><input type="submit" value="validate"/></form>
<br/>
------------------------------------------------------------------------------------------------------------
<br /> <pre>

<?php
if ($_REQUEST['transaction_id']):
    /* High Level call */
    $transaction_id=$_REQUEST['transaction_id'];
    $NimbleApi = new NimbleAPI($params);
    $response2 = NimbleAPIPayments::updateCustomerData($NimbleApi, $transaction_id, 'NEW_IDSAMPLE12345');
    var_dump($response2);
endif;
?>