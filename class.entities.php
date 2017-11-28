<?php


/**
* XSS preventer
*/
class xssPrevent
{
	
	public function validate($str){

		$out = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
		return $out;

	}
}


?>