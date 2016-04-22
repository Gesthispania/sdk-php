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
         'userId' => 'idCustomer12345'
        );

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);
/* High Level call */
$NimbleApi = new NimbleAPI($params);
?>
<hr />
<br />

<h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret */<br />
1.- Called to contructor: NimbleAPI(Array);<br />
2.- Called to NimbleAPIStoredCards::getStoredCards($NimbleApi, $payment['userId']);</h3>
<pre>
<?php
$response = NimbleAPIStoredCards::getStoredCards($NimbleApi, $payment['userId']);
var_dump($response);
?>
</pre>