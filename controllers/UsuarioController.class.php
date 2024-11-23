<?php
class UsuarioController
{
    public function cadastrar()
    {
        $titulo = ' - Cadastro';
        $style = array("assets/styles/styleUsuarioCadastro.css");
        $script = '';

        require_once "views/cabecalho.php";
        require_once "views/usuarioCadastro.html";
        require_once "views/rodape.html";
    }
}
