<?php
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
            $p_sql->setFetchMode(PDO::FETCH_CLASS, ucfirst(static::TABLE));
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
            $p_sql->setFetchMode(PDO::FETCH_CLASS, ucfirst(static::TABLE));
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
    public static function findAll($fk = [], $criterios = []){
        //Todo: Mutiplas Tabelas
        //select * from salas where para_id = 1 or

        try{
            $predicates = self::criterios($criterios,self::where($fk));
            $sql = 'SELECT * FROM '.static::TABLE. $predicates;
            $p_sql = Db::getInstance()->query($sql);


            $p_sql->setFetchMode(PDO::FETCH_CLASS, ucfirst(static::TABLE));
            $objects = $p_sql->fetchAll();

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
     * @return array
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
                //Se tiver mais de uma FK e não for a ultima posição
                $binder = (($size !== 1) && $counter !== ($size - 1)) ? ' and ' : '';

                //fk_id1 = 1 and fk_id2 = 2
                $fields[$key] = $key . ' = ' . "'".$value."'" . $binder;
                $counter++;
            }

            //Retorna os termos exemplo: usuarios_id=1 and clientes_id=1
            $join = ($fields)?' WHERE ' . implode($fields) . ' ' : ' ';
        }
        return $join;
    }

    /**
     * @param $criterios
     * @return string
     */
    public static function criterios($criterios,$sql = ''){
        $predicates ='';

        foreach ($criterios as $key => $value) {
            if(!$value){
                unset($criterios[$key]);
            }
        }

        if(count($criterios) != 0){
            foreach($criterios as $key => $value){
                if($key == 'limit'){
                    $predicates .= $key . ' ' . $value;
                }

                if($key == 'like'){
                    foreach($value as $where => $like) {
                        $predicates .= ' WHERE ' . $where . ' ' .$key. ' '. "'%" . $like . "%'";
                    }
                }

                if($key == 'or'){
                    foreach($value as $or){
                        $predicates .= $key . ' ' . $or. ' ';
                    }
                }

                if($key == '>'){
                    $sql = preg_replace('/^(.+?\=.+?)\=/', '$1>', $sql);//str_replace('=','>',$sql);
                }

                //Arrumar pragma e automatizar
                if($key == 'DESC'){
                    $predicates .= ' ORDER BY ' . $value . ' ' .$key . ' ';
                }
            }
        }

        return ($sql == '')? $predicates : $sql . $predicates;
    }

}
?>