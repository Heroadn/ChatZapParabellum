<?php


class Mensagens extends Dao
{
    const TABLE = 'mensagens';
    const PK = 'id';

    public $id;
    public $mensagem;
    public $data;

    public $usuarios_id;
    public $salas_id;

    function getMensagensFromSala(){
        $mensagem = Mensagens::findAll();
    }

    public function getFuncionarios(){
        $departamento = Departamento::findById($this->cod);
        return Funcionario::findAll($departamento->cod);
    }
}