<?php


class Salas extends Dao
{
    const TABLE = 'salas';
    const PK = 'id';
    const FK = '';

    public $id;
    public $nome;
    public $senha;
    public $moderador_id;
    public $categorias_id;
}
