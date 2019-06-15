<?php
$fb = new Facebook\Facebook([
    'app_id' => '{app-id}', // Replace {app-id} with your app id
    'app_secret' => '{app-secret}',
    'default_graph_version' => 'v2.2',
]);
?>

<form method="post" role="form" action="http://Chat.acid-software.net/Usuario/cadastrar_post"  enctype="multipart/form-data">
    <div class="form-group">
        <label for="nome_usuario">Nome do Usuario:</label>
        <input type="text" class="form-purple" name="nome" id="nome_usuario" aria-describedby="emailHelp" placeholder="Coloque seu nome de usuario aqui...">
        <small id="nameHelp" class="form-text text-muted">Coloque um nome maior que 5 digitos...</small>
    </div>
    <div class="form-group">
        <label for="email_usuario">Email do Cadastro:</label>
        <input type="email" class="form-purple" name="email" id="email_usuario" aria-describedby="emailHelp" placeholder="Coloque seu email aqui...">
        <small id="emailHelp" class="form-text text-muted">Não compartilhamos essa informação com ninguem...</small>
    </div>
    <div class="form-group">
        <label for="usuario_senha">Senha:</label>
        <input type="password" class="form-purple" name="senha" id="usuario_senha" placeholder="Escreva sua senha aqui...">
        <small id="nameHelp" class="form-text text-muted">Coloque uma senha maior que 5 digitos...</small>
    </div>
</form>

<script src="<?php echo JS . 'integridade_cadastro.js'?>"></script>

<script>
    var obj = { '===': "5", '>': "", foto: "NewYork" };
    verifyFormIntegrity('',obj);
</script>
