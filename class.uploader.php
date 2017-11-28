<?php

/*
Created by: 	Ivan Gajic,
Version: 	 	1.0,
Date created:	05. August 2016
Class name:		Uploader


Use example:

<?php

Uploader::upload($dir, $file, $req_file_typ, $max_size, $name, $unlink_if_exist);

?>





$dir 						-> required attribute, 
$file 						-> required attribute, 

$req_file_type 				-> not required attribute, 
$max_size					-> not required attribute,  
$name 						-> not required attribute, 
$unlink_if_exist 			-> not required attribute



*/

class Uploader
{
	
	public static function upload($dir, $file, $req_file_type = false, $max_size = false, $name = false, $unlink_if_exist = false)
	{
		$file_name 		= $file['name'];
		$file_type 		= $file['type'];
		$file_size 		= $file['size'];
		$file_tmp_name 	= $file['tmp_name'];

		$upload_ok 		= 1;

		if($name != false){
			$file_name = $name;
		}

		if($req_file_type != false){
			if($req_file_type != $file_type){
				$upload_ok = 0;
				$return = "Wrong file type! Only $req_file_type files are allowed!";
			}
		}

		if($max_size != false){
			if($file_size > $max_size){
				$upload_ok = 0;
				$return = "Maximum file size is $max_size KB!";
			}
		}

		if($unlink_if_exist != false){
			if(file_exists($dir.$file_name)){
				unlink($dir.$file_name);
			}
		}

		if($upload_ok == 1){
			move_uploaded_file($file_tmp_name, $dir.$file_name);
			$return = "Uploaded!";			
		}
		echo $return;
			
	}
	
}

