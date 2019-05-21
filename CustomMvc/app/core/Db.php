<?php
/*
 * @author Benjamin de Castro Azevedo Ponciano
*/

class Db extends PDO{
    private $banco   = DATABASE;
    private $usuario = USER;
    private $senha   = PASS;
    private $host    = HOST;

    public static $instance;

    public static function getInstance(){

        if(!isset(self::$instance))
            self::$instance = new Db();

        return self::$instance;
    }

    function __construct(){
        $dsn = 'mysql:host='.$this->host. ';dbname=' .$this->banco.';charset=utf8';
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        try{
            parent::__construct($dsn,$this ->usuario,$this ->senha,$options);
        }
        catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
        }
    }
}