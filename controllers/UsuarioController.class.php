<?php
class UsuarioController
{
    public function cadastrar()
    {
        $titulo = ' - Cadastro';
        $style = array("assets/styles/styleUsuarioCadastro.css");
        $script = array();

        require_once "views/cabecalho.php";
        require_once "views/usuarioCadastro.html";
        require_once "views/rodape.html";
    }
    public function recuperarSenha()
    {
        $titulo = ' - Recuperar Senha';
        $style = array("assets/styles/styleEsqueceuSenha.css");
        $script = array();

        require_once "views/cabecalho.php";
        require_once "views/esqueceuSenha.html";
        require_once "views/rodape.html";
    }
}
