<?php
    if(isset($_SESSION['user_id'])){
        echo '<div class="card">';
            echo '<h4>' . 'Login detectado' .'</h4>';
            echo $_SESSION['user_nome'] . '<br>';
            echo $_SESSION['user_email'] . '<br>';
        echo '</div>';
    }
?>

<form class="form-horizontal" method="post" role="form" action="/Usuario/login_post"  enctype="multipart/form-data">
    <div class="form-group">
        <label for="email"><span style="color: dodgerblue">*</span>Email:</label><input class="form-control" name="email" type="email">
        <label for="senha"><span style="color: dodgerblue">*</span>Senha:</label><input class="form-control" name="senha" type="password">
    </div>
    <div class="clearfix"></div>
    <div class="text-right">
        <input type="submit" class="btn btn-primary" value="Entrar">
    </div>
</form>


