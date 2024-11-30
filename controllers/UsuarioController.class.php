<?php
class UsuarioController
{
    public function cadastrar()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        if (isset($_SESSION["logado"])) {
            header("location:/localize-jahu/");
            die();
        }
        $mensagem = array("", "");
        $erro = false;


        if ($_POST) {
            $usuarioDAO = new usuarioDAO();
            $usuario = new Usuario(0, $_POST["nome"], $_POST["email"], $_POST["telefone"], $_POST["cpf"],  senha: password_hash($_POST["senha"], PASSWORD_DEFAULT));

            $retorno = $usuarioDAO->verificarEmail($usuario);
            if ($retorno[0]->qtd > 0) {

                $mensagem[0] = "E-mail já cadastrado!";
                $erro = true;
            }
            $usuarioDAO = new usuarioDAO();
            $retorno = $usuarioDAO->verificarCpf($usuario);
            if ($retorno[0]->qtd > 0) {
                $mensagem[1] = "CPF já cadastrado!";
                $erro = true;
            }

            if (!$erro) {
                $usuarioDAO = new usuarioDAO();
                $usuarioDAO->inserirUsuario($usuario);

                header("location:/localize-jahu/login");
                die();
            }
        }
        require_once "views/usuarioCadastro.php";
    }

    public function login()
    {

        if(!isset($_SESSION)){
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
        session_start();
        $_SESSION = array();
        session_destroy();
        header("Location:/localize-jahu/");
        die();
    }

    public function configuracoes()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION["logado"])) {
            header("location:/localize-jahu/");
            die();
        }
        $mensagem = array("", "");
        $erro = false;
        $usuarioDAO = new usuarioDAO();
        $usuario = new Usuario(id_usuario: $_SESSION["id"]);
        $retorno = $usuarioDAO->pesquisarPorId($usuario);
        $usuario = $retorno[0];

        if ($_POST) {
            $usuarioAlterado = new Usuario(id_usuario: $_SESSION["id"], nome: $_POST["nome"], email: $_POST["email"], telefone: $_POST["telefone"]);
            $usuarioDAO = new usuarioDAO();
            $retorno = $usuarioDAO->verificarEmail($usuarioAlterado);

            if ($usuarioAlterado->getEmail() != $usuario->email) {
                if ($retorno[0]->qtd > 0) {
                    $mensagem[0] = "E-mail já cadastrado!";
                    $erro = true;
                }
            }

            $usuarioDAO = new usuarioDAO();
            $retorno = $usuarioDAO->login($usuarioAlterado);    

            if (count($retorno) == 1) {
                if (!(password_verify($_POST['senha'], $retorno[0]->senha))) {
                    $mensagem[1] = "Senha incorreta!";
                    $erro = true;
                }


                if (!$erro) {
                    $usuarioDAO = new usuarioDAO();
                    $retorno = $usuarioDAO->atualizar($usuarioAlterado);
                    if ($retorno) {
                        $mensagem[1] = "Atualizado com sucesso!";
                    } else {
                        $mensagem[1] = "Erro ao atualizar!";
                    }
                }
            }
        }
        require_once "views/usuarioConfiguracoes.php";
    }
}
