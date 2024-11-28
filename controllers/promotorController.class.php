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

    public function alterar() 
    {
        $msg = "";
        $promotorDAO = new PromotorDAO();
        

        if($_POST) 
        {
            if(empty($_POST["nome_publico"]))
            {
                $msg = "Preencha o seu nome";
            }

            else if(empty($_POST["biografia"]))
            {
                $msg = "Preencha a sua biografia";
            }

            else if(empty($_POST["instagram_link"]))
            {
                $msg = "Preencha com o link do seu instagram";
            }

            else if(empty($_POST["facebook_link"]))
            {
                $msg = "Preencha com o link do seu facebook";
            }

            else if(empty($_POST["telefone_contato"]))
            {
                $msg = "Preencha o seu telefone";
            }

            else if(empty($_POST["email_contato"]))
            {
                $msg = "Preencha o seu email";
            }

            else {
                $promotor = new Promotor( 
                    $_POST["idpromotor"],
                    $_POST["nome_publico"],
                    $_POST["biografia"],
                    $_POST["instagram_link"],
                    $_POST["facebook_link"],
                    $_POST["telefone_contato"],
                    $_POST["email_contato"]
                );
                $retorno = $promotorDAO->alterar_promotor($promotor);
                header("location:/localize-jahu/promotor?msg=$retorno");
            } 
        }
        if(isset($_GET["id"])) 
        {
            $promotor = new Promotor($_GET["id"]); 
            $promotorDAO = new PromotorDAO;
            $retorno = $promotorDAO->buscar_promotor($promotor);
        }
        require_once "views/editarPerfil.php";
    }
} //fim da classe

?>