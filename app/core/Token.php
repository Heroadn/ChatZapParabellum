<?php
namespace core;

class Token
{
    const HEADER = ['alg' => 'HS256','typ' => 'Token'];
    const SECRET = 'ad%282629240sndfls$';

    public static function objToPayload($obj)
    {
        return json_decode(json_encode($obj), true);
    }

    public static function saveTokenOnSession($session,$token){
        $_SESSION[$session] = Token::encode($token);
    }

    public static function encode($payload = []){
        $header = json_encode(self::HEADER);
        $header = base64_encode($header);

        $payload = json_encode($payload);
        $payload = base64_encode($payload);//$secret

        $signature = hash_hmac('sha256',"$header.$payload",self::SECRET,true);
        $signature = base64_encode($signature);

        return "$header.$payload.$signature";
    }

    public static function decode($token){
        $validate = self::validate($token);
        return ($validate) ? json_decode(base64_decode(explode(".",$validate)[1])) : $validate;
    }

    public static function validate($token){
        if(isset($token)){
            $part = explode(".",$token);
            $header = $part[0];
            $payload = $part[1];
            $signature = $part[2];

            $valid = hash_hmac('sha256',"$header.$payload",self::SECRET,true);
            $valid = base64_encode($valid);

            if($signature == $valid){
                return $token;
            } else{
                return false;
            }
        }
    }

    public static function getTokenFromHeaders($name,$error = ['erro'=>'Autenticação é requerida']){//AUTHORIZATION
        return (isset(apache_request_headers()[$name]))? Token::decode(apache_request_headers()[$name]) : $error;
    }

    public static function getTokenFromHeadersOrSession($session,$headers){
        return isset($_SESSION[$session]) ? Token::decode($_SESSION[$session]) : Token::getTokenFromHeaders($headers);
    }
}