<?php
namespace core;
use \PDO;
use PDOException;

/*
 * @author Benjamin de Castro Azevedo Ponciano [benbenjamin554@gmail.com]
 * @author Thiago Venancio
*/

class Dao{
    /**
     * Dao constructor.
     * @param null $id
     */

    public function __construct($id = NULL){
        if(isset($id)){
            $model = $this->findById($id);

            if($model){
                foreach ($model as $key => $value){
                    $this->$key = $value;
                }
            }
        }
    }

    /**
     * @param $model
     * @return bool
     */
    public function save(){
        $model = $this;
        $rows = array_keys(get_object_vars($model));
        $fields = [];

        foreach($rows as $key => $value){
            $fields[$key] = $rows[$key] . '=:' .$rows[$key];
        }

        try{
            if(empty($model->{static::PK})){
                $sql ='INSERT INTO '.static::TABLE.'('.implode(',',$rows).') VALUES (:'. implode(',:',$rows) .')';

                $p_sql = Db::getInstance()->prepare($sql);
                foreach($rows as $value){
                    $p_sql->bindValue(':'.$value,$model->$value);
                }
            }else{
                $sql = 'UPDATE '.static::TABLE.' set '.implode(',',$fields).' WHERE '.static::PK.' = :'.static::PK;
                $p_sql = Db::getInstance()->prepare($sql);

                foreach($rows as $key => $value){
                    $p_sql->bindValue(':'.$value, $model->$value);
                }
            }
            $p_sql->execute();

            return $p_sql->execute();
        }catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage().'\r\n',
                FILE_APPEND);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function findById($id){
        try{
            $sql = 'SELECT * FROM '.static::TABLE.'
							WHERE '.static::PK.' = :'.static::PK;
            $p_sql = Db::getInstance()->prepare($sql);
            $p_sql->bindParam(':'.static::PK,$id);
            $p_sql->setFetchMode(PDO::FETCH_CLASS, ucfirst('\\model\\'. static::TABLE));
            $p_sql->execute();
            return $p_sql->fetch();
        }catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
        }
    }

    /**
     * @param $field campo do banco de dados que se deseja procurar
     * @param $string valor do campo
     * @return mixed
     */
    public static function findBy($field, $string){
        try{
            $sql = 'SELECT * FROM '.static::TABLE.'
							WHERE '.$field.' = :'.$field.'';

            $p_sql = Db::getInstance()->prepare($sql);
            $p_sql->bindParam(':'.$field,$string);
            $p_sql->setFetchMode(PDO::FETCH_CLASS, ucfirst('\\model\\'. static::TABLE));
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
        }
    }

    /**
     * Metodo retorna mais de uma incidencia de busca do banco de dados
     * pode ser passado as chaves de busca assim como criterios que limitam os resultados
     *
     * Exemplo:
     * $var = [];
     * $var = Model::findAll(); O modelo obrigatoriamente deve extender Dao,
     * já que ele busca o nome da tabela pelo modelo
     * $Usuarios = Usuarios::findAll();
     *
     * Procurar varios clientes pertencentes a usuarios
     * //Tabela usuarios;
     * $Usuarios = [];
     *
     * //Foreign Key clientes_id
     * $fk = [clientes_id=>1];
     * $Usuarios = Usuarios::findAll($fk);
     *
     * Limitando os resultados de busca usando limit
     * //Tabela usuarios;
     * $Usuarios = [];
     *
     * //Foreign Key clientes_id
     * $fk = [clientes_id=>1];
     *
     * //Criterios de pesquisa
     * $criterios = [limit=>10];
     * $Usuarios = Usuarios::findAll($fk,$criterios);
     *
     * @param  array $fk chaves estrangeiras para se procurar como [usuarios_id=>1,clientes_id=>2]
     * @param  array $criterios criterios de pesquisa como ['limit'=>10]
     * @return array retorna os objetos de pesquisa do banco de dados
     */

    public static function count(){
        $criterios = ['count'=>'*'];

        try{
            $sql = self::sqlBuilder($criterios,'');
            $count = Db::getInstance()->query($sql)->fetchColumn();
            return $count;
        }catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
        }
    }

    public static function findAll($fk = [], $criterios = []){
        //Todo: Mutiplas Tabelas
        //select * from salas where para_id = 1 or

        try{
            $sql = self::sqlBuilder($criterios,self::where($fk));
            $p_sql = Db::getInstance()->query($sql);

            $p_sql->setFetchMode(PDO::FETCH_CLASS, ucfirst(static::TABLE));
            $objects = $p_sql->fetchAll(PDO::FETCH_CLASS, ucfirst('\\model\\'. static::TABLE));

            return $objects;
        }catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id){
        try{
            $sql = 'DELETE FROM '.static::TABLE.' WHERE '.static::PK.'=' . $id;
            $p_sql = Db::getInstance()->prepare($sql);
            $p_sql->query($p_sql);

            return $p_sql->execute();
        }catch(PDOException $e){
            file_put_contents("erros.txt",
                $e->getMessage()."\r\n",
                FILE_APPEND);
        }
    }

    public static function tableShow(){
        $sql = 'show Tables from ' . DATABASE;
        $p_sql = Db::getInstance()->query($sql);
        $p_sql->execute();

        $tables = [];
        foreach ($p_sql->fetchAll() as $key => $table){
            array_push($tables,$table['Tables_in_' . DATABASE]);
        }

        return $tables;
    }

    /**
     * @param null $table
     * @return array
     */
    public static function tableDescribe($table = null){
        $table  = (isset($table))? $table : static::TABLE;
        $sql = 'DESCRIBE ' . $table;
        $p_sql = Db::getInstance()->query($sql);
        $p_sql->execute();
        return $p_sql->fetchAll(PDO::FETCH_COLUMN);
    }

    //SQL HELPERS //
    /**
     * Metodo faz a adição de elementos de procurar como por exemplo
     *
     * É informado as foreign keys usuarios_id e clientes_id
     * O que ele faz é retorna isso como usuarios_id=1 and clientes_id=1
     *
     * @param $fk
     * @return string
     */
    public static function where($fk)
    {
        $join = '';

        if (count($fk) != 0) {
            $fields = [];
            $size = count($fk);
            $counter = 0;

            /*Verifica se o valor da chave informada não esta vazio
            * neste caso é removida do array
            */
            foreach ($fk as $key => $value) {
                if(!$value){
                    unset($fk[$key]);
                    $size--;
                }
            }

            //Retorna o join com as foreign keys em SQL
            foreach ($fk as $key => $value) {
                $binder = (($size !== 1) && $counter !== ($size - 1)) ? ' and ' : '';

                $fields[$key] = $key . ' = ' . "'".$value."'" . $binder;
                $counter++;
            }

            //Retorna os termos exemplo: usuarios_id=1 and clientes_id=1
            $join = ($fields)?' WHERE ' . implode($fields) . ' ' : ' ';
        }
        return $join;
    }

    /**
     * @param $criteria
     * @return string
     */
    public static function sqlBuilder($criteria, $where = ''){
        $select = 'SELECT ';//*
        $from   = 'FROM '.static::TABLE;
        $attributes = '*';
        $conditions ='';

        foreach ($criteria as $key => $value) {
            if(!$value){
                unset($criteria[$key]);
            }
        }

        if(count($criteria) != 0){
            foreach($criteria as $key => $value){

                if($key == 'limit'){
                    $limit = is_array($value)? implode(',',$value) : $value;
                    $conditions .= ' ' .$key . ' ' . $limit;
                }

                if($key == 'like'){
                    foreach($value as $pred => $like) {
                        $conditions .= ' WHERE ' . $pred . ' ' .$key. ' '. "'%" . $like . "%'";
                    }
		
                }

				if($key == 'arraylike'){
					$coluna = $value[0];
					$conditions = ' WHERE ';
					foreach($value[1] as $termo){
						$conditions .= $coluna . ' LIKE ' . "'%" . $termo . "%'" . ' OR ';
					}
					$conditions = substr($conditions, 0, -3);
				}
                if($key == 'or'){
                    foreach($value as $or){
                        $conditions .= $key . ' ' . $or. ' ';
                    }
                }

                if($key == 'count'){
                    $attributes = 'Count(' . $value. ') ';
                }

                if($key == '>'){
                    $where = preg_replace('/^(.+?\=.+?)\=/', '$1>', $where);//str_replace('=','>',$sql);
                }

                //Arrumar pragma e automatizar
                if($key == 'DESC'){
                    $conditions .= ' ORDER BY ' . $value . ' ' .$key . ' ';
                }
            }
        }

        return $select . $attributes . $from . $where . $conditions;
    }

}
?>