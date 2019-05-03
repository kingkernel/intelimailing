<?php
class ER {
	public function __construct(){

	}
	public function numXplode($string, $separador){
		
		$result = explode($separador, $string);
		return $result;
	}
}
?>