<?php
class UsuarioController
{
    public function cadastrar()
    {

        if (isset($_SESSION["logado"])) {
            header("location:/localize-jahu/");
            die();
        }
        $mensagem = "";


        if ($_POST) {
            $usuarioDAO = new usuarioDAO();
            $usuario = new Usuario(0, $_POST["nome_completo"], $_POST["email"], $_POST["telefone"], $_POST["cpf"],  senha: password_hash($_POST["senha"], PASSWORD_DEFAULT));

            $retorno = $usuarioDAO->verificarEmail($usuario);
            if ($retorno[0]->qtd > 0) {

                $mensagem = "E-mail já cadastrado!";
            } else {
                $usuarioDAO = new usuarioDAO();
                $usuarioDAO->inserirUsuario($usuario);

                header("location:/localize-jahu/login");
                die();
            }
        }
        require_once "views/usuarioCadastro.php";
    }
}
