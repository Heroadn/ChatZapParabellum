<?php
namespace core;

class Upload{

    public static function save($fieldName,$prefix=''){
        $target_dir = UPLOADS . $prefix;
        $target_file = $target_dir . 'resource_'.mt_rand(0, 10000);
        $file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


        $check = Upload::checkFile($fieldName);
		if ($check === 2){
			$dir = '';
		}
		else {
			$err = ($check !== false)? false : true;
			$dir = (!$err)? DIRECTORY_SEPARATOR . $target_file : false;
			if(!$err) { move_uploaded_file($_FILES[$fieldName]["tmp_name"],$target_file); };			
		}

        return $dir;
    }

    public static function checkFile($fieldName){
        $file = $_FILES[$fieldName];
        if($file['name']) {
            $errors = array();

            $fileExtenion = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
            $acceptable = array('jpeg', 'jpg', 'gif', 'png');

            if((!in_array($fileExtenion, $acceptable)) && (!empty($_FILES[$fieldName]['type']))) {
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
		else {
			return 2;
		}
    }
}