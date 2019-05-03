<?php
class ER {
	public function __construct(){

	}
	public function numXplode($string, $separador){
		
		$result = explode($separador, $string);
		return $result;
	}
	public function mysqlReplace($table, $campo, $find, $replace = ""){
		$sql = 'update '.$table.' set '.$campo.'= replace('.$campo.', "'.$find.'", "'.$replace.'")';
		return $sql;
	}
}
?>