<?php

$helper = new FacebookRedirectLoginHelper('\fbretorno.php');
echo '<a href="' . $helper->getLoginUrl() . '">Login with Facebook</a>';
// Use the login url on a link or button to redirect to Facebook for authentication


?>
