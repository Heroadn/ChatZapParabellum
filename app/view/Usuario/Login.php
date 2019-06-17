<?php
    if(isset($_SESSION['user_id'])){
        echo '<div class="card">';
            echo '<h4>' . 'Login detectado' .'</h4>';
            echo $_SESSION['user_nome'] . '<br>';
            echo $_SESSION['user_email'] . '<br>';
        echo '</div>';
    }
?>

<div class= "div_login_internal">

	<h1 class="p-text"> Login no ZapChat</h1>

	<h4 class="p-text">	Entre na sua conta com seu nome de usuario. </h4>
	<p class="p-text" style="font-size: 10px;"><i> *Por favor não tentar hackear... </i></p>

	<form method="post" action="/Usuario/login_post"  enctype="multipart/form-data">

		<div class="form-group">
			<label  for="email">Endereço de Email</label>
			<input  class="form-purple "type="email" name="email" class="form-control" id="email_login" aria-describedby="emailHelp" placeholder="Escreva seu email...">
	  	</div>

		<div class="form-group">
			<label for="senha">Senha:</label>
			<input class="form-purple" type="password" name="senha"  id="senha_login" placeholder="Escreva sua senha aqui...">
			<small id="nameHelp" class="form-text text-muted">Coloque uma senha maior que 5 digitos...</small>
		</div>

		<input type="checkbox" name="remember" id="lembrar"/>
		<label for="remember-me">Lembrar o nome do usuario?</label>

		<br>
		<a href="#">Esqueceu a senha?</a>
		<br><br>
		<button type="submit" class="btn btn-purple purple" onClick="logonOn()">Entrar</button>
	</form>
</div>
