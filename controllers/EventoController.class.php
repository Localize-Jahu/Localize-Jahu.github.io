<?php
class EventoController
{
    public function cadastrar()
    {


        $titulo = ' - Cadastrar Evento';
        $style = "<link rel='stylesheet' href='assets/styles/styleEventoCadastro.css'>";
        $script = '';

        require_once "views/cabecalho.php";
        require_once "views/barraNavegacao.html";
        require_once "views/eventoCadastro.html";
        require_once "views/rodape.html";
    }

    public function exibir()
    {

        $titulo = ' - Evento';
        $style = "<link rel='stylesheet' href='assets/styles/styleEventoExibir.css'>";
        $script = '';

        require_once "views/cabecalho.php";
        require_once "views/barraNavegacao.html";
        require_once "views/eventoExibir.html";
        require_once "views/rodape.html";
    }
}
