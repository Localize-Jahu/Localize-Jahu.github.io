<?php

class PromotorController
{
    public function mostrar_info()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $promotor = new Promotor($_SESSION["id_promotor"]);
        $promotorDAO = new PromotorDAO();
        $retorno = $promotorDAO->pesquisarPorId($promotor);
        $titulo = '- Perfil Promotor';
        $style = array("assets/styles/stylepromotor.css");
        $script = array();

        require_once "views/cabecalho.php";
        require_once "views/promotorPerfil.php";
        require_once "views/rodape.html";
    }

    public function perfil_publico()
    {
        if ($_GET) {
            $promotor = new Promotor($_GET["idpromotor"]);
            $promotorDAO = new PromotorDAO();
            $retorno = $promotorDAO->pesquisarPorId($promotor);
            $titulo = '-' . $retorno[0]->nome_publico;
            $style = array("assets/styles/stylepromotor.css");
            $script = array();

            require_once "views/cabecalho.php";
            require_once "views/promotorPerfilPublico.php";
            require_once "views/rodape.html";
        } else {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }
    }

    public function alterar()
    {
        $msg = "";
        $promotorDAO = new PromotorDAO();


        if ($_POST) {
            if (empty($_POST["nome_publico"])) {
                $msg = "Preencha o seu nome";
            } else if (empty($_POST["biografia"])) {
                $msg = "Preencha a sua biografia";
            } else if (empty($_POST["telefone_contato"])) {
                $msg = "Preencha o seu telefone";
            } else if (empty($_POST["email_contato"])) {
                $msg = "Preencha o seu email";
            } else {
                $promotor = new Promotor(
                    $_POST["idpromotor"],
                    $_POST["nome_publico"],
                    $_POST["biografia"],
                    $_POST["telefone_contato"],
                    $_POST["email_contato"],
                    $_POST["website"]
                );
                $retorno = $promotorDAO->alterarPromotor($promotor);
                header("location:/localize-jahu/promotor_perfil?msg=$retorno");
            }
        }

        if (!isset($_SESSION)) {
            session_start();
        }
        $promotor = new Promotor($_SESSION["id_promotor"]);
        $promotorDAO = new PromotorDAO();
        $retorno = $promotorDAO->pesquisarPorId($promotor);
        $titulo = '- Perfil Editar';
        $style = array("assets/styles/stylepromotor.css");
        $script = array();

        require_once "views/cabecalho.php";
        require_once "views/promotorEditar.php";
        require_once "views/rodape.html";
    }
} //fim da classe
