<?php
require_once 'functions.php';
require_once '../lib/Nimble/base/NimbleAPI.php';

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);

/* High & Low Level call */
$response = new NimbleAPI($params);

?>
<hr />
<h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret */<br/>
1.- Called to contructor: NimbleAPI(Array);</h3>
<pre>
<?php
    var_dump($response);
?>
</pre>