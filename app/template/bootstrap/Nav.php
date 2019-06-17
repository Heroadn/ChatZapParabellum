<?php
    $controller = $this->getController();
    $action = $this->getAction();
?>

<nav class="navbar navbar-expand-md navbar-dark purple">
  <div class="container">
    <a class="navbar-brand h1 mb-0 mr-5 menutitle" href="#" style="color: var(--font-light)">
      <img alt="asdasd" src="resouce/logowhite_zapchat.png" width="40px">
      &nbsp;&nbsp; ZapChat
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite" style="color: white">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container"></div>
    <div class="collapse navbar-collapse" id="navbarSite">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/zapzap">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/zapzap?escolha=2">Login</a>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="/zapzap?escolha=3">Salas</a>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="/zapzap?escolha=4">Paginas</a>

        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#editarperfil">Editar Pefil</a>
          <?php require("modal_editar_perfil.php") ?>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Sair</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
