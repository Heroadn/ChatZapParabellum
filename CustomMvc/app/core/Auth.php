<?php


class Auth
{
    public static function getTokenFromHeaders($name,$error = ['erro'=>'Autenticação é requerida']){//AUTHORIZATION
        return (isset($_SERVER['HTTP_'.$name]))? JWT::decode($_SERVER['HTTP_'.$name]) : $error;
    }
}