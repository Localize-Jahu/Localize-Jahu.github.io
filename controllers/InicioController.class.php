<?php
class InicioController
{
    public function inicio()
    {
        $eventoDAO = new EventoDAO;
        $proximos = $eventoDAO->proximosEventos(); 
        $eventoDAO = new EventoDAO;
        $populares = $eventoDAO->eventosPopulares();

        $titulo = '';
        $style = array("assets/styles/styleHome.css");
        $script = array("https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js","assets/scripts/scriptHome.js");

        require_once "views/cabecalho.php";
        require_once "views/index.php";
        require_once "views/rodape.html";
    }
}
