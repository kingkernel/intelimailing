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
	public function updateCep(){
		$sql = 'Select * from viabilidade_fibra2';
		$query = queryDb($sql);
		$data = $query->fetch(PDO::FETCH_ASSOC); 
		
		$presql = "update viabiliadade_fibra2 set municipio=";
		foreach ($collection as $value) {
			
		}

/*
#### table ###
id
ddd2
ddd3
ddd_parenteses
municipio
bairro
codlogr
tipolograd
logradouro
lotenum
cep
poligono

### json ###
{
      "cep": "01001-000",
      "logradouro": "Praça da Sé",
      "complemento": "lado ímpar",
      "bairro": "Sé",
      "localidade": "São Paulo",
      "uf": "SP",
      "unidade": "",
      "ibge": "3550308",
      "gia": "1004"
    }
### por rua ###
viacep.com.br/ws/RS/Porto Alegre/Domingos+Jose/json/
*/
	}
}
?>