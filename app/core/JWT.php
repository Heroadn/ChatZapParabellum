<?php
namespace core;

class JWT
{
    const HEADER = [
        'alg' => 'HS256',
        'typ' => 'JWT'
    ];

    const SECRET = 'ad%282629240sndfls$';

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
}