<?php
//show code
//highlight_file("/info/authentication.php");
require_once '../lib/Nimble/base/NimbleAPI.php';
require_once 'functions.php';

$params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET
);
$NimbleApi = new NimbleAPI($params);
?>
<hr />
<br />
<form action="#"><label>CODE</label><input type="text" name="code"/><input type="submit" value="validate"/></form>
<br/>
<hr />
<h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret */<br/>
1.- Called to contructor: NimbleAPI(Array);<br/>
2.- Called to method: $NimbleApi->getOauth3Url();</h3>

<a href="<?php echo $NimbleApi->getOauth3Url();?>">$NimbleApi->getOauth3Url();</a>

<br />
<?php

if (isset($_REQUEST['code'])):
    $params = array(
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET,
        'oauth_code' => $_REQUEST['code']
    );
    $NimbleApi2 = new NimbleAPI($params);
    ?>
    <h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret, oauth_code */<br/>
    3.- Called to contructor: NimbleAPI(Array);<br/></h3>
    <p>Authentication Success(3 Steps)!!!!</p>
  
    <h4>ACCESS TOKEN: </h4>
    <span><?php echo $NimbleApi2->authorization->getAccessToken(); ?></span>
    <h4>REFRESH TOKEN: </h4>
    <span><?php echo $NimbleApi2->authorization->getRefreshToken(); ?></span>
    
    <?php
    $_SESSION["access_token"] = $NimbleApi2->authorization->getAccessToken();
    $_SESSION["refresh_token"] = $NimbleApi2->authorization->getRefreshToken();
endif;

?>