<?php
class ContatoController
{
    public function inicio()
    {
        $titulo = ' - Contato';
        $style = array("assets/styles/styleContato.css");
        $script = array();

        require_once "views/cabecalho.php";
        require_once "views/Contato.html";
        require_once "views/rodape.html";
    }
}
