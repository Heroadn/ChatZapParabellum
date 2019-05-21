<?php
#Definindo o template e pastas CSS e JS
define('TEMPLATE_SELECTED','Bootstrap');
define('DEFAULT_PAGE','/Usuario/Cadastrar');

#Recursos CSS, JS e Imagens
define('CSS' , LIBS .  'css' . DIRECTORY_SEPARATOR);
define('JS'  , LIBS .  'js'  . DIRECTORY_SEPARATOR);
define('IMG' , LIBS .  'img' . DIRECTORY_SEPARATOR);

#Banco de dados
define('DATABASE','zadmin_chat');
define('HOST','localhost');
define('USER','root');
define('PASS','');

#Segurança
define('SALT',md5('1ff2Sh@aj33f2&#&3Ssf%goa$s1'));
define('SECURE',false);
define('DEBUG' ,true);