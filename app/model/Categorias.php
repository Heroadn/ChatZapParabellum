<?php
namespace model;
use PDO;
use PDOException;
use core\Db;
use core\Dao;

class Categorias extends Dao
{
    const TABLE = 'categorias';
    const PK = 'id';

    public $id;
    public $nome;
	public $foto_categoria;
	public $descricao;
	
	public static function getRelevantes($page=1, $limit=10){
		try{
			$sql = "SELECT c.id, c.nome, COUNT(DISTINCT usuarios_id) AS qtd_usuarios  FROM categorias c LEFT JOIN salas s ON c.id=s.categorias_id LEFT JOIN usuarios_salas u ON u.salas_id=s.id GROUP BY c.id, s.categorias_id ORDER BY (qtd_usuarios) DESC LIMIT $page, $limit";
            $p_sql = Db::getInstance()->prepare($sql);
            $p_sql->execute();
			return $p_sql->fetchAll(PDO::FETCH_OBJ);
		}
		
		catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
		}
			
		//SQL ANTIGO
		/*SELECT c.id, c.nome, COUNT(salas_id) AS qtd_usuarios  FROM categorias c LEFT JOIN salas s ON c.id=s.categorias_id LEFT JOIN usuarios_salas u ON u.salas_id=s.id GROUP BY c.id, s.categorias_id ORDER BY (qtd_usuarios) DESC*/
	}
	
	public static function getCategoriasWithSalas(){
		try{
			$sql = "SELECT salas.nome,categorias.nome FROM salas,usuarios WHERE categorias_id=categorias.id ORDER BY categorias.nome ASC";
            $p_sql = Db::getInstance()->prepare($sql);
            $p_sql->execute();
			return $p_sql->fetchAll(PDO::FETCH_OBJ);
		}
		
		catch(PDOException $e){
            file_put_contents("erros.txt",$e->getMessage()."\r\n", FILE_APPEND);
		}		
	}
	
}