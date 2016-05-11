<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once '../lib/Nimble/api/NimbleAPIPayments.php';
require_once 'functions.php';

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);
$params['token'] = base64_decode($_SESSION['session_token']);
?>
<hr />
<h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret<br />
1.- Called to contructor: NimbleAPI(Array);<br />
2.- Called to NimbleAPIPayments::getPayments($NimbleApi, $filters)</h3>
<pre>
<?php
    $filters = array();
    $filters['itemsPerPage'] = '1';
    if (isset($_REQUEST['itemReference'])){
        $filters['itemReference'] = $_REQUEST['itemReference'];
    }
    
    $NimbleApi = new NimbleAPI($params);
    $response2 = NimbleAPIPayments::getPayments($NimbleApi, $filters);
    var_dump($response2);
    if($response2['data'] && $response2['data']['itemReference'] && isset($response2['data']['itemReference'])){
        echo "<a href='?itemReference=" . $response2['data']['itemReference'] . "' >siguiente</a>";
    }
            
?>
</pre>