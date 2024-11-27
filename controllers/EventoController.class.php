<?php
class EventoController
{
    public function cadastrar()
    {
        $titulo = ' - Cadastrar Evento';
        $style = array("assets/styles/styleEventoCadastro.css");
        $script = array();

        require_once "views/cabecalho.php";
        require_once "views/eventoCadastro.html";
        require_once "views/rodape.html";
    }

    public function exibir()
    {

        $titulo = ' - Evento';
        $style = array("assets/styles/styleEventoExibir.css");
        $script = array();

        require_once "views/cabecalho.php";
        require_once "views/eventoExibir.html";
        require_once "views/rodape.html";
    }

    public function calendario()
    {   

        $titulo = ' - Calendário';
        $style = array("assets/styles/styleCalendario.css");
        $script = array();

        $mes = null;
        $ano = null;

        if (!$_GET) {
            $mes = date('n');
            $ano = date('Y');
        } else {
            $mes = intval($_GET['mes']);
            $ano = intval($_GET['ano']);
        }


        require_once "views/cabecalho.php";
        require_once "views/calendario.php";
        require_once "views/rodape.html";
    }
}
