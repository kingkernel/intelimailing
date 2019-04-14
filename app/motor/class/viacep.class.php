<?php
class viacep{
	public $cep;
	public $format = "json";
	public function __construct(){

	}
	public function getOnCep(){
		$url = 'viacep.com.br/ws/'.$this->cep.'/'.$this->format.'/unicode';
		$curl = curl_init();
		curl_setopt($url, CURLOPT_URL, $url);
		print_r($curl);
	}
}
?>