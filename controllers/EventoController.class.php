<?php
class EventoController
{
    public function cadastrar()
    {
        $titulo = ' - Cadastrar Evento';
        $style = array("assets/styles/styleEventoCadastro.css");
        $script = array();

        $msg = array("", "", "", "", "", "", "", "", "", "", "");
        $erro = false;

        if ($_POST) {
            if (empty($_POST["titulo"])) {
                $msg[0] = "Preencha o titulo";
                $erro = true;
            }
            if (empty($_POST['cep'])) {
                $msg[1] = 'O cep é obrigatório!';
            }
           
            if (empty($_POST["bairro"])) {
                $msg[2] = "Preencha o bairro!";
                $erro = true;
            }
            if (empty($_POST['logradouro'])) {
                $msg[3] = 'Preencha o logradouro!';
                $erro = true;
            }
            if (empty($_POST["cidade"])) {
                $msg[4] = "Preencha a cidade!";
                $erro = true;
            }
            if (empty($_POST["uf"])) {
                $msg[5] = "Preencha o uf!";
                $erro = true;
            }
            if ($_FILES["imagem"]["name"] == "") {
                $msg[6] = "Escolha uma imagem!";
                $erro = true;
            } else if ($_FILES["imagem"]["type"] != "image/png" && $_FILES["imagem"]["type"] != "image/jpg" && $_FILES["imagem"]["type"] != "image/jpeg") {
                $msg[6] = "Tipo de Imagem Inválido!";
                $erro = true;
            } else {
                $diretorio = "uploads/";
                $imagemNome = uniqid() . "-" . $_FILES["imagem"]["name"];

                if (!move_uploaded_file($_FILES["imagem"]["tmp_name"], $diretorio . $imagemNome)) {
                    $msg[10] = "Erro ao fazer upload da imagem!";
                    $erro = true;
                }
            }
            if (empty($_POST['descricao'])) {
                $msg[7] = 'Preencha a descricao do evento!';
                $erro = true;
            }

            // categoria
            if ($_POST["categoria"] == "0") {
                $msg[8] = "Escolha uma categoria!";
                $erro = true;
            }
            if (!$erro) {
                $categoria = new Categoria($_POST["categoria"]);
                $evento = new Evento(0, $_POST["titulo"], $_POST["cep"], $_POST["bairro"], $_POST["logradouro"], $_POST["cidade"], $_POST["uf"], $_FILES["imagem"]["name"], $_POST["descricao"], "Pendente",  $categoria);
            }
            if (!$erro) {
                $promotor = new Promotor();
                $evento = new Evento(0, $_POST["titulo"], $_POST["cep"], $_POST["bairro"], $_POST["logradouro"], $_POST["cidade"], $_POST["uf"], $_FILES["imagem"]["name"], $_POST["descricao"], "Pendente",  $categoria, $promotor);
            }



            if (!$erro) {
                $categoria = new Categoria($_POST["categoria"]);
                $evento = new Evento(
                    0,
                    $_POST["titulo"],
                    $_POST["cep"],
                    $_POST["bairro"],
                    $_POST["logradouro"],
                    $_POST["cidade"],
                    $_POST["uf"],
                    $imagemNome,
                    $_POST["descricao"],
                    "Pendente",
                    $categoria,
                    $promotor            
                );
                $eventoDAO = new EventoDAO();
                $retorno = $eventoDAO->inserir($evento);

                header("location:/localize-jahu/evento?mensagem=$retorno");
                exit;
            }
        }
        $categoriaDAO = new CategoriaDAO();
        $retorno = $categoriaDAO->listar();
        require_once "views/cabecalho.php";
        require_once "views/eventoCadastro.php";
        require_once "views/rodape.html";
    }

    public function calendario()
    {

        $titulo = ' - Calendário';
        $style = array("assets/styles/styleCalendario.css");
        $script = array();

        $mes = null;
        $ano = null;

        if (!$_GET) {
            $mes = date('n');
            $ano = date('Y');
        } else {
            $mes = intval($_GET['mes']);
            $ano = intval($_GET['ano']);
        }


        require_once "views/cabecalho.php";
        require_once "views/calendario.php";
        require_once "views/rodape.html";
    }

    public function listar()
    {
        $titulo = ' - Exibir Evento';
        $style = array("assets/styles/styleEventoExibir.css");
        $script = array();

        if (isset($_GET["idevento"])) {
            $evento = new Evento($_GET["idevento"]);
            $eventoDAO = new eventoDAO;
            $retorno = $eventoDAO->buscarUmEvento($evento);
            require_once "views/cabecalho.php";
            require_once "Views/eventoExibir.php";
            require_once "views/rodape.html";
        }
    }


    public function alterarSituacao()
    {
        if (isset($_GET["idevento"])) {
            $evento = new Evento(id_evento: $_GET["idevento"], situacao: $_GET["situacao"]);
            $eventoDAO = new EventoDAO();
            $eventoDAO->mudarSituacao($evento);
            header("location:/localize-jahu/evento");
            die();
        }
    }

    public function alterar()
    {
        $titulo = ' - Alterar Evento';
        $style = array("assets/styles/styleEditarEvento.css");
        $script = array();

        $msg = array("", "", "", "", "", "", "", "", "", "");
        $erro = false;
        if ($_POST) {
            if (empty($_POST["titulo"])) {
                $msg[0] = "Preencha o titulo";
                $erro = true;
            }
            if (empty($_POST['logradouro'])) {
                $msg[1] = 'Preencha o logradouro!';
                $erro = true;
            }
            if (empty($_POST['descricao'])) {
                $msg[2] = 'Preencha a descricao!';
                $erro = true;
            }
            if (empty($_POST['cep'])) {
                $msg[3] = 'Preencha o cep!';
                $erro = true;
            }
            if (empty($_POST["bairro"])) {
                $msg[4] = "Preencha o bairro!";
                $erro = true;
            }
            if (empty($_POST["cidade"])) {
                $msg[5] = "Preencha a cidade!";
                $erro = true;
            }
            if (empty($_POST["uf"])) {
                $msg[6] = "Preencha o uf!";
                $erro = true;
            }
            if (isset($_FILES["imagem"]) && $_FILES["imagem"]["name"] != "") {
                if ($_FILES["imagem"]["type"] != "image/png" && $_FILES["imagem"]["type"] != "image/jpg" && $_FILES["imagem"]["type"] != "image/jpeg") {
                    $msg[7] = "Tipo de Imagem Inválido!";
                    $erro = true;
                } else {
                    $diretorio = "uploads/";

                    $imagemNome = uniqid() . "_" . $_FILES["imagem"]["name"];

                    if (!move_uploaded_file($_FILES["imagem"]["tmp_name"], $diretorio . $imagemNome)) {
                        $msg[7] = "Erro ao fazer upload da imagem!";
                        $erro = true;
                    }
                }
            } else {
                $imagemNome = $_POST["imagem_antiga"];
            }
            if ($_POST["categoria"] == "0") {
                $msg[8] = "Escolha uma categoria!";
                $erro = true;
            } else {
                $categoria = new Categoria($_POST["categoria"]);
                $promotor = new Promotor($_POST["idpromotor"]);
                $evento = new Evento($_POST["idevento"], $_POST["titulo"], $imagemNome, $_POST["descricao"], $_POST["uf"], $_POST["cidade"], $_POST["bairro"], $_POST["logradouro"], $_POST["cep"], "Pendente", $categoria, $promotor);
                $eventoDAO = new eventoDAO;
                $retorno = $eventoDAO->alterarEvento($evento);
                header("location:/localize-jahu/eventos?msg=$retorno");
            }
        }
        if (isset($_GET["id"])) {
            $evento = new Evento($_GET["id"]);
            $eventoDAO = new eventoDAO;
            $retorno = $eventoDAO->buscarUmEvento($evento);
        }
        require_once "views/cabecalho.php";
        require_once "Views/editEvento.php";
        require_once "views/rodape.html";
    }
}
