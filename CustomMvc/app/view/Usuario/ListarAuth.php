<?php
//Verifica se o usuario está logado
if(!isset($_SESSION['usuario_email']) && $_SESSION['usuario_admin'] == 1) {
    header('Location:' . '/Usuario/Login');
}

echo json_encode($Usuarios);
