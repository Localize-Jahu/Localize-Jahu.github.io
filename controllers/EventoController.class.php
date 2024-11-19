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
        require_once "views/barraNavegacao.html";
        require_once "views/eventoExibir.html";
        require_once "views/rodape.html";
    }
}
