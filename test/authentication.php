<?php
//show code
highlight_file("/info/authentication.php");
?>
<br />
------------------------------------------------------------------------------------------------------------
<br />
<?php
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once 'functions.php';

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET,
        'mode' => NimbleAPIConfig::MODE
);

/* High & Low Level call */
$response = new NimbleAPI($params);

?>

<br /> <pre>
Response:
<?php
var_dump($response);
?>