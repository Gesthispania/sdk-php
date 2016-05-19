<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once '../lib/Nimble/api/NimbleAPIStoredCards.php';
require_once 'functions.php';

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);
/* High Level call */
$NimbleApi = new NimbleAPI($params);
?>
<hr />
<br />
<h3 style="background-color: #d0e4fe;">1.- Called to NimbleAPIStoredCards::getStoredCards($NimbleApi, 'idCustomer12345');</h3>    
<pre>
<?php 
    $responseCard = NimbleAPIStoredCards::getStoredCards($NimbleApi, 'idCustomer12345');
    var_dump($responseCard);
?>    
    <h3 style="background-color: #d0e4fe;">2.- Called to NimbleAPIStoredCards::deleteAllCards($NimbleApi, $cardHolderId);</h3>  
<?php 
    var_dump('********** All delete Cards *************');
    $response = NimbleAPIStoredCards::deleteAllCards($NimbleApi, 'idCustomer12345');
    var_dump($response);
?>
</pre>