<?php
class ContatoController
{
    public function inicio()
    {

        $titulo = ' - Contato';
        $style = "<link rel='stylesheet' href='assets/styles/styleContato.css'>";
        $script = '';

        require_once "views/cabecalho.php";
        require_once "views/barraNavegacao.html";
        require_once "views/Contato.html";
        require_once "views/rodape.html";
    }
}

