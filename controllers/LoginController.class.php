<?php
class LoginController
{
    public function login()
    {

        if (!isset($_SESSION)) {
            session_start();
        }
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

                    if (isset($_POST["lembrar"])) {
                        self::lembrarMim($retorno[0]->email);
                    }


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

        $usuario = (isset($_COOKIE["sisgen_user"])) ? $_COOKIE["sisgen_user"] : "";
        require_once "views/login.php";
    }

    public function logout()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION = array();
        session_destroy();
        self::esquecer();
        header("Location:/localize-jahu/");
        die();
    }

    private static function lembrarMim($user)
    {

        $validade = strtotime("+1 month");

        setcookie("sisgen_user", $user, $validade, "/", "", false, true);
    }

    private static function esquecer()
    {
        setcookie("sisgen_user", "", time() - 3600, "/", "", false, true);
    }
}
