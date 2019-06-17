<?php
$fb = new Facebook\Facebook([
    'app_id' => '750854629068948', // Replace {app-id} with your app id
    'app_secret' => '9f633bf40ba5075f49f45b8e82420d6c',
    'default_graph_version' => 'v2.2',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://example.com/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
?>

<button onclick="checkLoginState();">XD</button>


<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '{750854629068948}',
            cookie     : true,
            xfbml      : true,
            version    : '{v3.3}'
        });

        FB.AppEvents.logPageView();

    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    }
</script>

