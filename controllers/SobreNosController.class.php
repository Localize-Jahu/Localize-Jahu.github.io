<?php
class SobreNosController
{
    public function inicio()
    {
        $titulo = ' - Sobre Nós';
        $style = array("assets/styles/styleSobreNos.css");
        $script = array();

        require_once "views/cabecalho.php";
        require_once "views/SobreNos.html";
        require_once "views/rodape.html";
    }
}

