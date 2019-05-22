<?php


class Assert
{
    public static function equalsOrError($property1, $property2, $error = false){//AUTHORIZATION
        return (isset($property1) && isset($property2) && $property1 == $property2)?  : $error;
    }
}