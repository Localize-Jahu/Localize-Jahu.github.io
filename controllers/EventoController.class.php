<?php
class EventoController
{
    public function cadastrar()
    {
        require_once "views/cabecalho.html";

        echo "
            <title>Localize Jahu - Cadastrar Evento</title>
            <link rel='stylesheet' href='assets/styles/styleEventoCadastro.css'>
            ";

        require_once "views/barraNavegacao.html";
        require_once "views/eventoCadastro.html";
        require_once "views/rodape.html";
    }
 
    public function exibir(){
        require_once "views/cabecalho.html";

        echo "
            <title>Localize Jahu - Evento</title>
            <link rel='stylesheet' href='assets/styles/styleEventoExibir.css'>
            ";

        require_once "views/barraNavegacao.html";
        require_once "views/eventoExibir.html";
        require_once "views/rodape.html";

    }

}


