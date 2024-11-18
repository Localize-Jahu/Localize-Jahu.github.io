<?php
class UsuarioController {
    function cadastrar() {

        $titulo = ' - Cadastro';
        $style = "<link rel='stylesheet' href='assets/styles/styleUsuarioCadastro.css'>";
        $script = '';

        require_once "views/cabecalho.php";
        require_once "views/barraNavegacao.html";
        require_once "views/usuarioCadastro.html";
        require_once "views/rodape.html";
    }
}
