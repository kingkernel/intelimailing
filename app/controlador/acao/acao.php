<?php
/*
Data criação: 28/03/2019
*/
class acao {
	public function __construct(){
		$page = new page;
		$this->page = $page;
		return $this->page;
	}
	public function index (){

	}
	public function chamados(){
	$panel_0 = new rowAlert;
    $panel_0->colSize = "md-12";
    $panel_0->class = "alert alert-warning";
    $panel_0->titleSize = "3";
    $panel_0->alertTitle = 'Chamados Abertos <span class="glyphicon glyphicon-tasks"></span>';
    
    $table = new table;
    $headers = ["Usuário", "Problema", "Estatus", "Ação"];
    $table->headers($headers);
    $sql = queryDb("call sp_sel_teccalled()");
    $arrayRow = [];
    while ($query = $sql->fetch(PDO::FETCH_ASSOC)) {
      if($query["estatus"] == "Aberto"){$class = "warning";} else {$class = "success";};
        array_push($arrayRow, '<tr><td>'.$query["nameperson"].'</td><td>'.$query["prob"].'</td><td><span class="label label-'.$class.'">'.$query["estatus"].'</span></td><td><form action="http://'.SITENAME.'/acao/updatecalled/" method="post"><select required="true" name="calledaction"><option value="">escolha</option><option value="Em Atendimento">Em atendimento</option><option value="Encerrado">Encerrado</option></select> <input type="submit" class="btn btn-success" value="Atualizar"><input type="hidden" name="id" value="'.$query["id"].'"></form></td></tr>');
      };
    $table->rows($arrayRow);

    $panel_0->alertText = $table->html();
    $sql = 'call sp_sel_teccalled()';
    $query = queryDb($sql);
    $dados =$query->fetch(PDO::FETCH_ASSOC);

		$this->page->bodycontent = $panel_0->html();
		$this->page->render();
	}
	public function updatecalled(){
		//print_r($_POST);
        //[calledaction] => Encerrado [id] => 1
        $acaochamado = $_POST["calledaction"];
        $idchamado = $_POST["id"];
        $sql = 'call sp_up_teccalled("'.$acaochamado.'", "'.$idchamado.'")';
            $alert = new rowAlert;
        try {
            queryDb($sql);
            $alert->alertTitle = 'Atualizado com Sucesso! <span class="glyphicon glyphicon-thumbs-up"><span>';
            $alert->alertText = '<p>Atuazado o chamado. click em voltar ou aguarde que será rediurecionado automaticamente</p><a class="btn btn-primary" href="/">Voltar</a>';
            $this->page->scriptsendpage = 'function reloadPage(){location.href="/";document.reload()}; window.setTimeout("reloadPage()", 6000);';
            $this->page->bodycontent = $alert->html();
            $this->page->render();
        } catch (Exception $e) {
            $alert->class = "alert alert-danger";
            $alert->alertTitle = 'Erro de atualização <span class="glyphicon glyphicon-thumbs-down"><span>';
            $alert->alertText = '<p>Pode ter ocorrido um erro de conexão com o banco de dados. Favor comunique a equipe de suporte</p><a class="btn btn-danger" href="/">Voltar</a>';
            $this->page->bodycontent = $alert->html();
            $this->page->scriptsendpage = 'function reloadPage(){location.href="/";document.reload()}; window.setTimeout("reloadPage()", 6000);';
            $this->page->render();
        }
	}
}
?>