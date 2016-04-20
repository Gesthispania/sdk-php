<?php
//show code
//highlight_file("/info/payment_send.php");
?>
<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once '../lib/Nimble/api/NimbleAPIStoredCards.php';
require_once 'functions.php';

$payment = array(
           "amount"  => 21,
           "currency" => "EUR",
           "customerData" => "Stored_card_MY_DB_ID",
           "cardHolderId"  =>  "rafa"
        );

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);
/* High Level call */
$NimbleApi = new NimbleAPI($params);
?>
<br /> <pre>
------------- STORE CARD ----- payment ----------------------

Response:
<?php
$response = NimbleAPIStoredCards::payment($NimbleApi, $payment);
var_dump($response);
