<?php
class InicioController
{
    public function inicio()
    {
        require_once "views/cabecalho.html";

        echo "
            <title>Localize Jahu</title>
            <link rel='stylesheet' href='assets/styles/styleHome.css'>
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js' defer></script>
            <script src='assets/scripts/scriptHome.js' defer></script>
            ";

        require_once "views/barraNavegacao.html";
        require_once "views/index.html";
        require_once "views/rodape.html";
    }
}
