<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once '../lib/Nimble/api/NimbleAPIPayments.php';
require_once 'functions.php';

$payment = array(
    'amount' => 1010,
    'currency' => 'EUR',
    'merchantOrderId' => 'idSample12345',
    'paymentSuccessUrl' => 'https://my-commerce.com/payments/success',
    'paymentErrorUrl' => 'https://my-commerce.com/payments/error',
    'cardHolderId' => 'idCustomer12345'
);

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);
/* High Level call */
$NimbleApi = new NimbleAPI($params);
?>
<hr />
<h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret<br />
1.- Called to contructor: NimbleAPI(Array);<br />
2.- Called to NimbleAPIPayments::SendPaymentClient($NimbleApi, $payment);</h3>
<pre>
<?php
$response = NimbleAPIPayments::SendPaymentClient($NimbleApi, $payment);
var_dump($response);
echo "<hr /><h4>Called to gateway Nimble: ";
echo "<a href='{$response['data']['paymentUrl']}'>{$response['data']['paymentUrl']}</a></h4>";
?>
</pre>