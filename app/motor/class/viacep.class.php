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
		print_r($dados);
	}
	public function getOnName(){
		$url = 'viacep.com.br/ws/'.$this->estado.'/'.$this->cidade.'/'.$this->logradouro.'/json/';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		$dados = curl_exec($curl);
		return $dados;
	}
}
?>