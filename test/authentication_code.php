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
    $NimbleApi = new NimbleAPI($params);
    ?>
    <h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret, oauth_code */<br/>
    3.- Called to contructor: NimbleAPI(Array);<br/></h3>
    <p>Authentication Success(3 Steps)!!!!</p>
  
    <pre>Token: <?php echo ($NimbleApi->authorization->getAccessToken());?> </pre>
    <pre>RefreshToken:  <?php echo ($NimbleApi->authorization->getRefreshToken());?> </pre>
    
    <?php
    $params = array(
            'clientId' => CLIENT_ID,
            'clientSecret' => CLIENT_SECRET,
            'token' => 'old_token',
            'refreshToken' => $NimbleApi->authorization->getRefreshToken()
    );
    $NimbleApi2 = new NimbleAPI($params);
    
    //$response2 = NimbleAPIAuth::refreshToken($NimbleApi2);
    ?>
    <h3 style="background-color: #d0e4fe;">/* params: clientId, clientSecret, token, refreshToken */<br/>
    4.- Called to contructor: NimbleAPI(Array);<br/></h3>
    <p>New refleshToken Success!!!</p>
    
    <pre>Token: <?php echo ($NimbleApi->authorization->getAccessToken());?> </pre>
    <pre>RefreshToken:  <?php echo ($NimbleApi->authorization->getRefreshToken());?> </pre>
    
    <hr>
    <h4>BASE64 OAUTH3 TOKEN: </h4>
    <textarea rows="6" cols="100" id="url_field"><?php echo base64_encode($NimbleApi2->authorization->getAccessToken()); ?></textarea>
    <input id="copy_btn" type="button" value="copy"/>
    
    <script>
          var copyBtn = document.querySelector('#copy_btn');
            copyBtn.addEventListener('click', function () {
                var urlField = document.querySelector('#url_field');

                // create a Range object
                var range = document.createRange();  
                // set the Node to select the "range"
                range.selectNode(urlField);
                // add the Range to the set of window selections
                window.getSelection().addRange(range);

                // execute 'copy', can't 'cut' in this case
                document.execCommand('copy');
            }, false);
    </script>
    
    <?php
    $_SESSION["session_token"] = base64_encode($NimbleApi2->authorization->getAccessToken());
endif;

?>