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
	
	
	public function getUsuarios(){
		try{
			$sala_id = $this->id;
			$sql = "SELECT usuarios.id, usuarios.nome, usuarios.foto_perfil FROM usuarios, usuarios_salas WHERE usuarios_salas.usuarios_id=usuarios.id AND usuarios_salas.salas_id=$sala_id;";
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
				$sql = "INSERT INTO usuarios_salas(usuarios_id, salas_id) VALUES ($usuario_id, $sala_id)";
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
	
	public static function getRelevantes(){
		try{
			$sql = "SELECT salas.*, COUNT(salas_id) AS qtd_usuarios FROM salas LEFT JOIN usuarios_salas ON usuarios_salas.salas_id=salas.id GROUP BY usuarios_salas.salas_id, salas.id ORDER BY (qtd_usuarios) DESC";
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
	
}
