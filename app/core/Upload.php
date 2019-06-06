<?php


class Upload{
    
    public static function save($fieldName,$prefix=''){
        $target_dir = UPLOADS . $prefix;
        $target_file = $target_dir . 'resource_'.mt_rand(0, 10000);
        $file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


        $check = Upload::checkFile($fieldName);
        $err = ($check !== false)? false : true;
        $dir = (!$err)? DIRECTORY_SEPARATOR . $target_file : false;
        if(!$err) { move_uploaded_file($_FILES[$fieldName]["tmp_name"],$target_file); };

        return $dir;
    }
    public static function checkFile($fieldName){
        $file = $_FILES([$fieldName]);
        if(isset($file)) {
            $errors = array();
            /*
            $maxsize = '';
            */
            $acceptable = array($fieldname.'/pdf', $fieldname.'/jpeg', $fieldname.'/jpg', $fieldname.'/gif', $fieldname.'/png');
            /*
            if(($_FILES([$fieldName]['size']) >= $maxsize) || ($_FILES([$fieldName]['size']) == 0)) {
                $errors[] = 'File doesnt have the allowed size.';
            }
            */
            if((!in_array($_FILES([$fieldName]['type']), $acceptable)) && (!empty($_FILES([$fieldName]['type'])))) {
                $errors[] = 'Invalid file type. Only PDF, JPG, GIF and PNG types are accepted.';
            }
        
            if(count($errors) === 0) {
               return true;
            } else {
                foreach($errors as $error) {
                    echo '<script>alert("'.$error.'");</script>';
                }
            die();
            }
        }
    }  
}