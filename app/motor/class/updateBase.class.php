<?php
class updateBase{

	public $cep;
	public $logradouro;
	public $complemento;
	public $bairro;
	public $localidade;
	public $uf;
	public $unidade;
	public $ibge;
	public $gia;
	public function __construct(){

	}
	public function update($table, $columns=[], $values=[]){
		$results = array_combine($columns, $values);
		$presql = 'update '.$table.' set ';
		print_r($results);
	}
}
?>