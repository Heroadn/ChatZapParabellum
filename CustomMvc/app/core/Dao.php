<?php
/*
 * @author Benjamin de Castro Azevedo Ponciano
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
     * @param $field
     * @param $string
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
     * @param string $fk
     * @return array
     */
    public static function findAll($fk = [],$criterios = []){
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

    //SQL HELPERS //
    /**
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

            //Retorna o join com as foreign keys em SQL
            foreach ($fk as $key => $value) {
                //Se tiver mais de uma FK e não for a ultima posição
                $binder = ($size != 1 && $counter != $size - 1) ? ' and ' : '';

                //fk_id1 = 1 and fk_id2 = 2
                $fields[$key] = $key . ' = ' . $value . $binder;
                $counter++;
            }

            //Predicatos
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

        if(count($criterios) != 0){
            $criterio = '';
            //Criterios
            foreach($criterios as $key => $value){
                if($key == 'limit'){
                    $predicates .= $key . ' ' . $value;
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