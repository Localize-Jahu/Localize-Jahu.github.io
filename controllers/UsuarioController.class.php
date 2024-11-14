<?php
class UsuarioController {
    function cadastrar() {
        require_once "views/cabecalho.html";

        echo "
            <title>Localize Jahu - Cadastro Usuário</title>
            <link rel='stylesheet' href='assets/styles/styleUsuarioCadastro.css'>
            ";

        require_once "views/barraNavegacao.html";
        require_once "views/usuarioCadastro.html";
        require_once "views/rodape.html";
    }
}
