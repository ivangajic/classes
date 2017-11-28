<?php

/*
Created by: 	Ivan Gajic,
Version: 	 	1.0,
Description:	Custom class for reading, writing and appending text to file



Date created:	05. August 2016
Class name:		RW

/*

Use example

Read file:
<?php
$text = RW::Read($fileName);
?>

Write to file:
<?php
RW::Write($text, $fileName);
*>
Append text to the end of file:
<?php
RW::AppendText($text, $fileName);
?>
*/

class RW
{
	
	public static function Read($fileName)
	{
		$string = file_get_contents($fileName) or die("Unable to open file");
		return $string;
	}

	public static function Write($text, $fileName)
	{
		$fileToOpen = fopen($fileName, "w") or die("Unable to open file");
		fwrite($fileToOpen, $text."\n");
		fclose($fileToOpen);
	}

	public static function AppendText($text, $fileName) {

		$myfile = file_put_contents($fileName, $text.PHP_EOL , FILE_APPEND);

	}

}


