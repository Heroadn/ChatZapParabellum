<?php
##Definindo caminho Root do Sistema
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
define('APP',   ROOT .  'app' . DIRECTORY_SEPARATOR);

##Estrutura do sistema
define('VIEW',  APP . 'view'  . DIRECTORY_SEPARATOR);
define('MODEL', APP . 'model' . DIRECTORY_SEPARATOR);
define('CORE',  APP . 'core'  . DIRECTORY_SEPARATOR);
define('TEMPLATE',    APP . 'template'   . DIRECTORY_SEPARATOR);
define('CONTROLLER',  APP . 'controller' . DIRECTORY_SEPARATOR);
define('LIBS',DIRECTORY_SEPARATOR .  'app' . DIRECTORY_SEPARATOR .  'libs' . DIRECTORY_SEPARATOR);

#Modulos do Sistema a serem carregados
$modules = [ROOT,APP,CORE,CONTROLLER,TEMPLATE,MODEL,LIBS];

#Carregando Configuraçôes de Banco de dados, template e ExceptionHandler
$config = include('Config.php');
include_once("AutoLoader.php");
include_once(TEMPLATE . DIRECTORY_SEPARATOR . 'Config.php');

#Mensagem de erro quanto estiver em ambiente de desenvolvimento
if(DEBUG){ini_set('display_errors',1);error_reporting(-1);}

##Init
new Application;
