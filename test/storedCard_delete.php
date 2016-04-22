<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once '../lib/Nimble/api/NimbleAPIStoredCards.php';
require_once 'functions.php';

$cardInfo = array(
         "cardBrand" => "VISA",
         "maskedPan" => "************7775",
         "cardHolderId" => "idCustomer12345"
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
2.- Called to NimbleAPIStoredCards::getStoredCards($NimbleApi, 'idCustomer12345');</h3>
<pre>
<?php
$responseCard = NimbleAPIStoredCards::getStoredCards($NimbleApi, 'idCustomer12345');
//var_dump($responseCard);
if(count($responseCard['data']['storedCards'])>0){
    echo "Select to card: ";
?>
    <form method="post">
        <select name="card_default">
          <?php for($i = 0; $i < count($responseCard['data']['storedCards']); $i++) { ?>
            <option value="<?php echo base64_encode(json_encode($responseCard['data']['storedCards'][$i]));?>"><?php echo $responseCard['data']['storedCards'][$i]['maskedPan']?></option>
          <?php } ?>
        </select>
        <input type="submit" value="Submit the form"/>
    </form>    
<?php
}
else
    echo "There aren't stored cards";

$selectOption = (array)json_decode(base64_decode($_POST['card_default']));
//var_dump($selectOption)
if(isset($_POST['card_default'])){
    $cardInfo = array(
             "cardBrand"=> $selectOption['cardBrand'],
             "maskedPan" => $selectOption['maskedPan'],
             "cardHolderId" => "idCustomer12345"
            );
    ?></pre>
        <h3 style="background-color: #d0e4fe;">3.- Called to NimbleAPIStoredCards::deleteCard($NimbleApi, $cardInfo);</h3>    
        <pre>
    <?php 
    $response = NimbleAPIStoredCards::deleteCard($NimbleApi, $cardInfo);
    var_dump($response);
}
?>
</pre>