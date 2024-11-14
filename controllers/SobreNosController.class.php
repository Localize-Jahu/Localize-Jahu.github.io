<?php
class SobreNosController
{
    public function inicio()
    {
        require_once "views/cabecalho.html";

        echo "
            <title>Localize Jahu - Sobre Nós</title>
            <link rel='stylesheet' href='assets/styles/styleSobreNos.css'>
            ";

        require_once "views/barraNavegacao.html";
        require_once "views/SobreNos.html";
        require_once "views/rodape.html";
    }
}

