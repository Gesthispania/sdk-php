<?php
//show code
//highlight_file("/info/payment_send.php");
?>
<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once '../lib/Nimble/api/NimbleAPIStoredCards.php';
require_once 'functions.php';

$cardInfo = array(
         "cardBrand" => "VISA",
         "maskedPan" => "************7775",
         "cardHolderId" => "rafa"
        );

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);
/* High Level call */
$NimbleApi = new NimbleAPI($params);
?>
<br /> <pre>
------------- STORE CARD ----- deleteCard ----------------------

Response:
<?php
$response = NimbleAPIStoredCards::deleteCard($NimbleApi, $cardInfo);
var_dump($response);
