<?php
ini_set('display_errors',1);
error_reporting(-1);

##Definindo caminho Root do Sistema
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
define('APP',   ROOT .  'app' . DIRECTORY_SEPARATOR);

##Estrutura do sistema
define('VIEW',  ROOT .  'app' . DIRECTORY_SEPARATOR . 'view'  . DIRECTORY_SEPARATOR);
define('MODEL', ROOT .  'app' . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR);
define('DAO',   ROOT .  'app' . DIRECTORY_SEPARATOR . 'dao'   . DIRECTORY_SEPARATOR);
define('LIBS',DIRECTORY_SEPARATOR .  'app' . DIRECTORY_SEPARATOR .  'libs' . DIRECTORY_SEPARATOR);
define('CORE',  ROOT .  'app' . DIRECTORY_SEPARATOR . 'core'  . DIRECTORY_SEPARATOR);
define('TEMPLATE',    ROOT .  'app' . DIRECTORY_SEPARATOR . 'template'   . DIRECTORY_SEPARATOR);
define('CONTROLLER',  ROOT .  'app' . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR);

##Carregando Configuraçôes de Banco de dados, e template
include('Config.php');
include_once("AutoLoader.php");
include_once(TEMPLATE . TEMPLATE_SELECTED . DIRECTORY_SEPARATOR . 'Config.php');

##Init
new Application;
