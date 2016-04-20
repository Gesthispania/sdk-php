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

<br /> <pre>
Response:
<?php
var_dump($response);
?>