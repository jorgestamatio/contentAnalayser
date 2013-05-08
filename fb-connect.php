<?php 

include("backend/classes/facebook-php-sdk/src/facebook.php");

    $facebook = new Facebook(array(
      'appId'  => '515298228506843',
      'secret' => '2711bb4d1ac7278fd57b172f64a649ca',
    ));

    // Get User ID
    $user = $facebook->getUser();

    // Get the current access token
    $access_token = $facebook->getAccessToken();

    if ($user) {
      try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');
      } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
      }
    }



    //Login or logout url will be needed depending on current user state.

   





?>

