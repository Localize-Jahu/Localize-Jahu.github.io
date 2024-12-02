<?php

class PromotorController
{
    public function mostrar_info()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION["id_promotor"])) {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }
        $promotor = new Promotor($_SESSION["id_promotor"]);
        $promotorDAO = new PromotorDAO();
        $retorno = $promotorDAO->pesquisarPorIdPromotor($promotor);
        $titulo = '- Perfil Promotor';
        $style = array("assets/styles/stylepromotor.css");
        $script = array("");

        require_once "views/cabecalho.php";
        require_once "views/promotorPerfil.php";
        require_once "views/rodape.html";
    }

    public function perfil_publico()
    {
        if ($_GET) {
            $promotor = new Promotor($_GET["idpromotor"]);
            $promotorDAO = new PromotorDAO();
            $retorno = $promotorDAO->pesquisarPorIdPromotor($promotor);
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

        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION["id_promotor"])) {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }
        $msg = "";
        $promotorDAO = new PromotorDAO();


     
        if ($_POST) {

            $promotorDAO = new PromotorDAO();
            $promotor = new Promotor(
                id_promotor: $_POST["id_promotor"],
                nomePublico: $_POST["nome_publico"],
                biografia: isset($_POST["biografia"]) ? $_POST["biografia"] : "",
                telefoneContato: isset($_POST["telefone"]) ? $_POST["telefone"] : "",
                emailContato: isset($_POST["email_contato"]) ? $_POST["email_contato"] : "",
                website: isset($_POST["website"]) ? $_POST["website"] : "",
                id_usuario: $_SESSION["id"]
            );

            $promotorDAO->alterar($promotor);

            header('location:/localize-jahu/promotor_perfil?msg={$_POST["id_promotor"]}');
            die();
        }

        $promotor = new Promotor($_SESSION["id_promotor"]);
        $promotorDAO = new PromotorDAO();
        $retorno = $promotorDAO->pesquisarPorIdPromotor($promotor);

        if (count($retorno) == 0) {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }

        $promotor = $retorno[0];
        $titulo = '- Perfil Editar';
        $style = array("assets/styles/stylePromotorEditar.css");
        $script = array("assets/scripts/scriptPromotorEditar.js");

        require_once "views/cabecalho.php";
        require_once "views/promotorEditar.php";
        require_once "views/rodape.html";
    }

    public function cadastro()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION["logado"])) {
            if (isset($_SESSION["id_promotor"])) {
                header("location:/localize-jahu/promotor_perfil");
                die();
            }
            if (isset($_SESSION["adm"])) {
                header("location:/localize-jahu/pagina-nao-encontrada");
                die();
            }

            $mensagem = "";

            if ($_POST) {

                $promotorDAO = new PromotorDAO();
                $promotor = new Promotor(
                    nomePublico: $_POST["nome_publico"],
                    biografia: isset($_POST["biografia"]) ? $_POST["biografia"] : "",
                    telefoneContato: isset($_POST["telefone"]) ? $_POST["telefone"] : "",
                    emailContato: isset($_POST["email_contato"]) ? $_POST["email_contato"] : "",
                    website: isset($_POST["website"]) ? $_POST["website"] : "",
                    id_usuario: $_SESSION["id"]
                );

                $retorno = $promotorDAO->inserir($promotor);

                $_SESSION["id_promotor"] = $retorno;

                header("location:/localize-jahu/promotor_perfil?msg=$retorno");
                die();
            }

            $titulo = '- Cadastro Promotor';
            $style = array("assets/styles/stylePromotorCadastro.css");
            $script = array("assets/scripts/scriptPromotorCadastro.js");

            require_once "views/cabecalho.php";
            require_once "views/promotorCadastro.php";
            require_once "views/rodape.html";
        } else {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }
    }
} //fim da classe
