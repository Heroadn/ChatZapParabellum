<?php
namespace model;
use core\Dao;

class Mensagens extends Dao
{
    const TABLE = 'mensagens';
    const PK = 'id';

    public $id;
    public $mensagem;
    public $data;

    public $usuarios_id;
    public $salas_id;
    public $para_id;

    function getMensagensFromSala(){
        $mensagem = Mensagens::findAll();
    }

}