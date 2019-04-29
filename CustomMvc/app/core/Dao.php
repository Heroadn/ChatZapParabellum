<?php
	class Dao{
		public $model;
		public $table;
		
		public function __construct($table){
			$this->model = new $table;
			$this->table = strtolower(get_class($this->model));
		}
		
		public function save($model){
			$rows = array_keys(get_object_vars($model));
			$fields = [];
			
			foreach($rows as $key => $value){
				$fields[$key] = $rows[$key] . '=:' .$rows[$key]; 
			}
			
			try{
				if(empty($model->id)){
					$sql ='INSERT INTO '.$this->table.'('.implode(',',$rows).') VALUES (:'. implode(',:',$rows) .')';
				
					$p_sql = Db::getInstance()->prepare($sql);
					foreach($rows as $value){
						$p_sql->bindValue(':'.$value,$model->$value);
					}
				}else{
					$sql = 'UPDATE '.$this->table.' set '.implode(',',$fields).' WHERE id = :id';
					$p_sql = Db::getInstance()->prepare($sql);
					
					foreach($rows as $key => $value){
						$p_sql->bindValue(':'.$value, $model->$value);
					}
				}

				return $p_sql->execute(); 
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage().'\r\n',
				FILE_APPEND);
			}
		}
		
		public function findById($id){
			try{
				$sql = 'SELECT * FROM '.$this->table.'
							WHERE id = :id';
				
				$p_sql = Db::getInstance()->prepare($sql);
				$p_sql->bindParam(':id',$id);
				$p_sql->execute();
				return self::toModel($p_sql->fetch(PDO::FETCH_ASSOC));
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public function findBy($field,$string){
			try{
				$sql = 'SELECT * FROM '.$this->table.'
							WHERE '.$field.' = :'.$field.'';
				
				$p_sql = Db::getInstance()->prepare($sql);
				$p_sql->bindParam(':'.$field,$string);
				$p_sql->execute();
				return self::toModel($p_sql->fetch(PDO::FETCH_ASSOC));
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public function findAll(){
			$models = array();
			
			try{		
				$sql = 'SELECT * FROM '.$this->table.'';
				$p_sql = Db::getInstance()->query($sql);

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
		
		public function delete($id){
			try{
				$sql = 'DELETE FROM '.$this->table.' WHERE id = :id ';
				$p_sql = Db::getInstance()->prepare($sql);
				$p_sql->bindParam(':id',$id);
				
				return $p_sql->execute();
			}catch(PDOException $e){
				file_put_contents("erros.txt",
				$e->getMessage()."\r\n",
				FILE_APPEND);
			}
		}
		
		public function toModel($data){
			$model = new $this->table;
			$row[0] = array_keys(get_object_vars($model));//Nome dos Campos
			$row[1] = array();//Nome dos campos para bind
			$row[2] = array();
			
			foreach($row[0] as $key =>$value){
				$model->$value = $data[$value];
			}
			
			if(empty($data)){ 
				return false;
			}
			
			return $model;
		}
	}
?>