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
define('UPLOADS','app'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'uploads' . DIRECTORY_SEPARATOR);

#Modulos do Sistema a serem carregados
$modules = [ROOT,APP,CORE,CONTROLLER,TEMPLATE,MODEL,LIBS];

#Carregando Configuraçôes de Banco de dados, template e ExceptionHandler
include('Config.php');
include_once(TEMPLATE . DIRECTORY_SEPARATOR . 'Config.php');

#Mensagem de erro quanto estiver em ambiente de desenvolvimento
if(true){ini_set('display_errors',1);error_reporting(-1);}
date_default_timezone_set('America/Sao_Paulo');

set_include_path(get_include_path() .  PATH_SEPARATOR . implode(PATH_SEPARATOR,$modules));
include 'vendor/autoload.php';

##Init
new Application;
