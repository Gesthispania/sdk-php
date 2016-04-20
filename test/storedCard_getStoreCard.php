<?php
//show code
//highlight_file("/info/payment_send.php");
?>
<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once '../lib/Nimble/api/NimbleAPIStoredCards.php';
require_once 'functions.php';

$payment = array(
         'amount' => 1010,
	 'currency' => 'EUR',
         'customerData' => 'idSample12345',
         'paymentSuccessUrl' => 'https://my-commerce.com/payments/success',
         'paymentErrorUrl' => 'https://my-commerce.com/payments/error',
         'userId' => 'rafa'
        );

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);
/* High Level call */
$NimbleApi = new NimbleAPI($params);
?>
<br /> <pre>
------------- STORE CARD ----- getStoredCards ----------------------

Response:
<?php
$response = NimbleAPIStoredCards::getStoredCards($NimbleApi, $payment['userId']);
var_dump($response);
