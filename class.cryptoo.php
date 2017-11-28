<?php
/*
Created by: 	Ivan Gajic,
Version: 	 	1.0,
Description:	Custom hashing class, quite difficult to crack (I dare you, try this one: e3a89e9e2e553501904a91f41b943f94ec17b1fe )



Date created:	05. August 2016
Class name:		Cryptoo


Use example

<?php

$password = new Cryptoo("test");
echo $password->hash;

?>

f12641431aef0cb588fb64309de848ac678012fe 		 gets returned


*/


class Cryptoo { 
	public $stock;
	public $hash;
	function __construct($stock) {
		$string = $this::encrypt($stock);
		$this->hash = (string)$string;
	}

	public static function reverse($str){
	    preg_match_all('/./us', $str, $ar);
	    return join('',array_reverse($ar[0]));
	}

	public static function encrypt($stock)
	{
		$salt = sha1(md5(self::reverse($stock))); 
		$password = self::reverse(sha1(md5($stock.$salt)));
		return $password;
	}

}

