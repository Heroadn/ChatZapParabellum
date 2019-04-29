<?php
#Modulos do Sistema a serem carregados
$modules = [ROOT,APP,CORE,CONTROLLER,TEMPLATE,MODEL,DAO];

#Definindo o template e pastas CSS e JS
define('TEMPLATE_SELECTED','bootstrap');

#Recursos CSS, JS e Imagens
define('CSS' , LIBS .  'css' . DIRECTORY_SEPARATOR);
define('JS'  , LIBS .  'js'  . DIRECTORY_SEPARATOR);
define('IMG' , LIBS .  'img' . DIRECTORY_SEPARATOR);

#Banco de dados
define('DATABASE','zadmin_chat');
define('HOST','localhost');
define('USER','root');
define('PASS','root');

#Segurança
define('SALT',md5('1ff2Sh@aj33f2&#&3Ssf%goa$s1'));
define('SECURE',FALSE);