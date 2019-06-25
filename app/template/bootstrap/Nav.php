<?php
    $controller = $this->getController();
    $action = $this->getAction();
?>



<nav class="navbar navbar-expand-md navbar-dark purple">
  <div class="container">
    <a class="navbar-brand h1 mb-0 mr-5 menutitle" href="#" style="color: var(--font-light)">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite" style="color: white">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container"></div>
    <div class="collapse navbar-collapse" id="navbarSite">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="http://chat.acid-software.net/">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/Sala/Destaque">Salas</a>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="/Sala/">Criar Sala</a>

        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#editarperfil">Editar Pefil</a>
          <?php require("app/libs/js/modal_editar_perfil.php") ?>
        </li>
        <?php
        if (isset($_SESSION['Token'])){
          ?>
          <li class="nav-item">
            <a class="nav-link" href="/Usuario/logout_post">Sair</a>
          </li>
          <?php
        }
        else
        {
          ?>
          <li class="nav-item">
          <a class="nav-link" href="/Usuario/Cadastrar">Cadastre-se!</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="/Usuario/Login">Login</a>
          </li>
          <?php
        }

        ?>
      </ul>
    </div>
  </div>
  <script src= '<?php JS . 'img_insert.js'?>'></script>
  <script src='<?php JS . 'integridade_editar_perfil.js'?>'></script>
</nav>
