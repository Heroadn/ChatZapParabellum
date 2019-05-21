<?php


class Usuarios extends Dao
{
    const TABLE = 'usuarios';
    const PK = 'id';
    const FK = '';

    public $id;
    public $nome;
    public $senha;
    public $email;
    public $admin;
    public $foto_perfil;

}