<?php
class ContatoController
{
    public function inicio()
    {
        require_once "views/cabecalho.html";

        echo "
            <title>Localize Jahu - Contato</title>
            <link rel='stylesheet' href='assets/styles/styleContato.css'>
            ";

        require_once "views/barraNavegacao.html";
        require_once "views/Contato.html";
        require_once "views/rodape.html";
    }
}

