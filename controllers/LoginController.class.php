<?php


class LoginController
{
    public function login()
    {

        if (isset($_SESSION["logado"])) {
            header("location:/localize-jahu/");
            die();
        }
        $mensagem = "";
        if ($_POST) {
            //verificar no BD
            $usuario = new Usuario(email: $_POST["email"]);

            $usuarioDAO = new usuarioDAO();
            $retorno = $usuarioDAO->login($usuario);

            if (count($retorno) == 1) {
                if (password_verify($_POST['senha'], $retorno[0]->senha)) {


                    session_start();
                    $_SESSION["logado"] = true;
                    $_SESSION["id"] = $retorno[0]->id_usuario;
                    $_SESSION["nome"] = $retorno[0]->nome;
                    $_SESSION["adm"] = $retorno[0]->adm;

                    $promotor = new Promotor(id_usuario: $retorno[0]->id_usuario);
                    $promotorDAO = new PromotorDAO();
                    $retorno = $promotorDAO->pesquisarPorIdUsuario($promotor);

                    if (count($retorno) == 1) {
                        $_SESSION["id_promotor"] = $retorno[0]->id_promotor;
                    } else {
                        if (isset($_SESSION["id_promotor"])) {
                            unset($_SESSION["id_promotor"]);
                        }
                    }
                    header("location:/localize-jahu/");
                    die();
                }
            }
            $mensagem = "*Verifique os dados informados";
        }
        require_once "views/login.php";
    }

    public function logout()
    {
        $_SESSION = array();
        session_destroy();
        header("Location:/localize-jahu/");
        die();
    }
}
