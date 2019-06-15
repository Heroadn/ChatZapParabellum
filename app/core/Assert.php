<?php
namespace core;

class Assert
{
    public static function equalsOrError($equals, $compared, $error = false){//AUTHORIZATION
        return (isset($equals) && isset($compared) && $equals == $compared)?  : $error;
    }
}