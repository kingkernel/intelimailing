<?php
class viacep{
	public $cep;
	public $estado;
	public $cidade;
	public $logradouro;
	public $format = "json";
	public function __construct(){

	}
	public function getOnCep(){
		$url = 'viacep.com.br/ws/'.$this->cep.'/'.$this->format.'/unicode';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		$dados = curl_exec($curl);
		curl_close($curl);
		//print_r($dados);
	}
	public function getOnName(){
		$url = 'viacep.com.br/ws/'.$this->estado.'/'.$this->cidade.'/'.$this->logradouro.'/json/';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		//$dados = curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$dados = curl_exec($curl);
		curl_close($curl);
		return $dados;
	}
	public function prepareLogradouro(){
		$logradouro = explode(" ", $this->logradouro);
		$this->logradouro = implode("+", $logradouro);
		return $this->logradouro;
		//"viacep.com.br/ws/RS/Porto Alegre/Domingos+Jose/json/"
	}
}
?>