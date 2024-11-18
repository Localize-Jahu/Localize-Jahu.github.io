<?php
class SobreNosController
{
    public function inicio()
    {

        $titulo = ' - Sobre Nós';
        $style = "<link rel='stylesheet' href='assets/styles/styleSobreNos.css'>";
        $script = '';

        require_once "views/cabecalho.php";
        require_once "views/barraNavegacao.html";
        require_once "views/SobreNos.html";
        require_once "views/rodape.html";
    }
}

