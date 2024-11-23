<?php
class ErroController
{
    public function naoEncontrado()
    {
        $titulo = ' - Página não encontrada!';
        $style = array("assets/styles/styleErro.css");
        $script = array();

        require_once "views/cabecalho.php";
        require_once "views/paginaNaoEncontrada.html";
        require_once "views/rodape.html";
    }
}

