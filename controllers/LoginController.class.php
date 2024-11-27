<?php

if (!isset($_SESSION)) {
    session_start();
}
class LoginController
{
    public function login()
    {
        $mensagem = "";
        if ($_POST) {
            //verificar no BD
            $usuario = new Usuario(email: $_POST["email"]);

            $usuarioDAO = new usuarioDAO();
            $retorno = $usuarioDAO->login($usuario);

            if (count($retorno) == 1) {
                //encontrou
                //if (password_verify($_POST['senha'], $retorno[0]->senha)) {
                if (($_POST['senha'] == $retorno[0]->senha)) {
                    $_SESSION["id"] = $retorno[0]->id_usuario;
                    $_SESSION["nome"] = $retorno[0]->nome;
                    $_SESSION["adm"] = $retorno[0]->adm;
                    header("location:/localize-jahu/");
                    die();
                }
            }
            $mensagem = "*Verifique os dados informados";
        }
        require_once "views/login.php";
    }
}
