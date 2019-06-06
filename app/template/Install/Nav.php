<?php
    $controller = $this->getController();
    $action = $this->getAction();
?>

<li class="nav-item">
    <a class="nav-link" href="/Usuario/Cadastrar">Usuario Cadastrar</a>
</li>

<li class="nav-item">
    <a class="nav-link <?php echo ($action == 'Login')? 'active' : ''; ?>" href="/Usuario/Login">Usuario Login</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="/Usuario/Listar">Usuario Listar</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="/Categoria/Listar">Categoria Listar</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="/Categoria/Cadastrar">Categoria Cadastrar</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="/Sala/Cadastrar">Sala Cadastrar</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="/Sala/Listar">Sala Listar</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="/Sala/Conversar">Sala Conversa</a>
</li>
