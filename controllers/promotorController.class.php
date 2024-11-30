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
        $promotor = new Promotor(id_promotor:$_SESSION["id_promotor"]);
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
