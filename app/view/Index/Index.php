<?php
$fb = new Facebook\Facebook([
    'app_id' => '750854629068948', // Replace {app-id} with your app id
    'app_secret' => '{9f633bf40ba5075f49f45b8e82420d6c}',
    'default_graph_version' => 'v2.2',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://example.com/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
?>


<script src="<?php echo JS . 'integridade_cadastro.js'?>"></script>

<script>
    var obj = { '===': "5", '>': "", foto: "NewYork" };
    verifyFormIntegrity('',obj);
</script>
