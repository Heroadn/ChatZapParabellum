<?php
namespace model;
use PDO;
use PDOException;
use core\Dao;
use core\Db;

class Salas extends Dao
{
    const TABLE = 'salas';
    const PK = 'id';
    const FK = '';

    public $id;
    public $nome;
    public $senha;
	public $tags;
	public $foto_sala;
	public $descricao;
    public $moderador_id;
    public $categorias_id;
	
	
	public function getUsuarios(){
		try{
			$sala_id = $this->id;
			$sql = "SELECT usuarios.id, usuarios.nome, usuarios.foto_perfil, usuarios_salas.last_time FROM usuarios, usuarios_salas WHERE usuarios_salas.usuarios_id=usuarios.id AND usuarios_salas.salas_id=$sala_id;";
            $p_sql = Db::getInstance()->prepare($sql);
            $p_sql->execute();
			return $p_sql->fetchAll(PDO::FETCH_OBJ);
		}
		
		catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
		}
	}
	
	public function addUsuario($usuario_id, $sala_id){
		try{
			if (!$this->verificaSala($usuario_id, $sala_id)){
				$last_time=date('Y/m/d H:i:s');
				$sql = "INSERT INTO usuarios_salas(usuarios_id, salas_id, last_time) VALUES ($usuario_id, $sala_id, '$last_time')";
				
				$p_sql = Db::getInstance()->prepare($sql);
				$p_sql->execute();
			}
		}
		catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);			
		}
	}
	
	public function updateTimeUsuario($usuario_id){
		try{
			$sala_id = $this->id;
			$last_time = date('Y/m/d H:i:s');
			$sql = "UPDATE usuarios_salas SET last_time='$last_time' WHERE usuarios_id=$usuario_id AND salas_id=$sala_id";
            $p_sql = Db::getInstance()->prepare($sql);
            $p_sql->execute();
		}
		catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
		}
	}
	
	public function verificaSala($usuario_id, $sala_id){
		try{
			$sql = "SELECT id FROM usuarios_salas WHERE usuarios_id=$usuario_id AND salas_id=$sala_id;";
            $p_sql = Db::getInstance()->prepare($sql);
            $p_sql->execute();
			return $p_sql->fetch();
		}
		catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
			return 1;
		}
	}
	
	public function deleteUsuario($usuario_id){
		try{
			$sala_id = $this->id;
			$sql = "DELETE FROM usuarios_salas WHERE usuarios_id=$usuario_id AND salas_id=$sala_id";
            $p_sql = Db::getInstance()->prepare($sql);
            $p_sql->execute();
		}
		catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
		}
	}
	
	public static function getRelevantes($start=0, $limit=9999999999){
		try{
			$sql = "SELECT salas.*, COUNT(salas_id) AS qtd_usuarios FROM salas LEFT JOIN usuarios_salas ON usuarios_salas.salas_id=salas.id GROUP BY usuarios_salas.salas_id, salas.id ORDER BY (qtd_usuarios) DESC LIMIT $start,$limit";
            $p_sql = Db::getInstance()->prepare($sql);
            $p_sql->execute();
			return $p_sql->fetchAll(PDO::FETCH_OBJ);
		}
		
		catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
		}		
	}
	
	public static function listar_por_categoria($parametro, $start=0, $limit=9999999999){
		try{
			$sql = "SELECT s.* FROM salas s, categorias c WHERE s.categorias_id=c.id AND (c.id='$parametro' OR c.nome='$parametro') LIMIT $start,$limit";
			
            $p_sql = Db::getInstance()->prepare($sql);
            $p_sql->execute();
			return $p_sql->fetchAll(PDO::FETCH_OBJ);
		}
		
		catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
		}		
	}

	public static function listar_por_usuario($parametro, $start=0, $limit=9999999999){
		try{
			$sql = "SELECT s.* FROM salas s, usuarios_salas us, usuarios u WHERE s.id=us.salas_id AND us.usuarios_id=u.id AND (u.id='$parametro' OR u.nome='$parametro') LIMIT $start,$limit";
            $p_sql = Db::getInstance()->prepare($sql);
            $p_sql->execute();
			return $p_sql->fetchAll(PDO::FETCH_OBJ);
		}
		
		catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
		}		
	}
	
	public function banirUsuario($usuario_id=''){
		try{
			if (!$this->isBanido($usuario_id)){
				$sala_id = $this->id;
				$sql = "INSERT INTO salas_banidos(usuarios_id, salas_id) VALUES($usuario_id, $sala_id)";
				$p_sql = Db::getInstance()->prepare($sql);
				$p_sql->execute();
			}
		}
		catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
		}		
	}
	
	public function desbanirUsuario($usuario_id=''){
		try{
			$sala_id = $this->id;
			$sql = "DELETE FROM salas_banidos WHERE usuarios_id=$usuario_id AND salas_id=$sala_id";
            $p_sql = Db::getInstance()->prepare($sql);
            $p_sql->execute();
		}
		catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
		}		
	}
	
	public function isBanido($usuario_id=''){
		try{
			$sala_id = $this->id;
			$sql = "SELECT id FROM salas_banidos WHERE usuarios_id=$usuario_id AND salas_id=$sala_id";
            $p_sql = Db::getInstance()->prepare($sql);
            $p_sql->execute();
			return $p_sql->fetch();
		}
		catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
			return 1;
		}
	}
	
}
