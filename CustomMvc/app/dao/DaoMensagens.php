<?php
/*
 @Author Heroadn
*/

class DaoMensagens extends Dao{
	
	public function __construct(){
		parent::__construct(str_replace('Dao','',get_class($this)));
	}
	
	//Carrega todas as perguntas relacionadas a id_questionario
	//(1 x N)
	public function getPerguntas($fk){
		$models = array();
		
		try{		
			$sql = 'SELECT * FROM '.$this->table.' WHERE id_questionario = :id';
			$p_sql = Conexao::getInstance()->prepare($sql);
			$p_sql->bindParam(':id',$fk);
			$p_sql->execute();
			
			$objects = $p_sql->fetchAll(PDO::FETCH_ASSOC);
			foreach($objects as $model){
				$models[] = self::toModel($model);
			}

			return $models;
		}catch(PDOException $e){
			file_put_contents("erros.txt",
			$e->getMessage()."\r\n",
			FILE_APPEND);
		}
	}
		
}
