<?php
set_include_path(get_include_path() .  PATH_SEPARATOR . implode(PATH_SEPARATOR,$modules));
spl_autoload_register(function($class) {
    require $class . '.php';
});
