<?php
namespace core;

class Auth
{
    public static function getTokenFromHeaders($name,$error = ['erro'=>'Autenticação é requerida']){//AUTHORIZATION
        return (isset(apache_request_headers()[$name]))? JWT::decode(apache_request_headers()[$name]) : $error;
    }
}