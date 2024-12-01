<?php
class OcorrenciaController
{
    public function excluir()
    {

        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION["id_promotor"])) {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }
        if (!isset($_GET) || !isset($_GET["id_ocorrencia"]) || !isset($_GET["id_evento"]) || !isset($_GET["id_promotor"])) {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }

        $ocorrencia = new Ocorrencia();
        $ocorrencia->setID($_GET["id_ocorrencia"]);
        $ocorrenciaDAO = new OcorrenciaDAO();
        $retorno = $ocorrenciaDAO->pesquisarPorId($ocorrencia);

        if (empty($retorno)) {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }


        if ($retorno->id_evento != $_GET["id_evento"]) {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }

        if ($retorno->id_promotor != $_GET["id_promotor"]) {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }

        if ($retorno->id_promotor != $_SESSION["id_promotor"]) {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }
        
        $ocorrenciaDAO = new OcorrenciaDAO();
        $ocorrenciaDAO->excluir($ocorrencia);

        header("location:/localize-jahu/alterarEvento?id=" . $_GET["id_evento"]);
    }
}
