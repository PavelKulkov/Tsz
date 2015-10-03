<html>
  <body>
    <form action="" method="post">
<?php
require_once("config.inc.php");
require_once("core/lib/captcha/recaptchalib.php");
require_once("config_system.inc.php");

// Get a key from https://www.google.com/recaptcha/admin/create
$publickey = "6LcywNoSAAAAAHELcbDntqcfQc7VB6RFrO_2PiJM";
$privatekey = "6LcywNoSAAAAAFEVTLel7jOGRqftxrWkgAqOCHvj";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

# was there a reCAPTCHA response?
if (isset($_POST["recaptcha_response_field"])) {
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

        if ($resp->is_valid) {
          $authHome = new AuthHome(NULL);
          $authHome->initGuestConnection($guestUser);
          $db = $authHome->getCurrentDBConnection();          
          $dump = new Dumper($db);
          $params  = array();
          $params = serialize($params);
                    
          $dump->setProperty($_SERVER['REMOTE_ADDR'], $params);      
          echo "Подтверждение получено!";
          header('Refresh: 3; URL=/index.php');
        } else {
          # set the error code so that we can display it
          $error = $resp->error;
        }
}
echo recaptcha_get_html($publickey, $error,$use_ssl=true);
?>
    <br/>
    <input type="submit" value="submit" />
    </form>
  </body>
</html>
