<?php
//show code
//highlight_file("/info/payment_send.php");
?>
<br />
------------------------------------------------------------------------------------------------------------
<br />

<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once '../lib/Nimble/api/NimbleAPIPayments.php';
require_once 'functions.php';

    
$payment = array(
         'amount' => 1010,
	  'currency' => 'EUR',
         'customerData' => 'idSample12345',
         'paymentSuccessUrl' => 'https://my-commerce.com/payments/success',
         'paymentErrorUrl' => 'https://my-commerce.com/payments/error'
        );

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);
/* High Level call */
$NimbleApi = new NimbleAPI($params);
?>
<br /> <pre>
Response:
<?php
$response = NimbleAPIPayments::SendPaymentClient($NimbleApi, $payment);
var_dump($response);

echo "<br/><a href='{$response['data']['paymentUrl']}'>{$response['data']['paymentUrl']}</a>";