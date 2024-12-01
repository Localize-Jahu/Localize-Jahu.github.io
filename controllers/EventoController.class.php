<?php
class EventoController
{
    public function cadastrar()
    {

        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION["logado"])) {

            if (isset($_SESSION["id_promotor"])) {



                $mensagem = "";
                $erro = false;
                $imagemNome = '';

                $diretorio = "uploads/";

                if ($_POST) {

                    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["name"] != "") {
                        $extensao = pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION);
                        $imagemNome = uniqid() . "." . $extensao;

                        if (!is_dir($diretorio)) {
                            mkdir($diretorio, 0755, true);
                        }

                        if (!file_exists($diretorio . $imagemNome)) {
                            if (!move_uploaded_file($_FILES["imagem"]["tmp_name"], $diretorio . $imagemNome)) {
                                $mensagem = "Erro ao fazer upload da imagem!";
                                $erro = true;
                            }
                        }
                    } else {
                        $imagemNome = "sem-imagem.png";
                    }



                    if (!$erro) {

                        $promotor = new Promotor($_SESSION["id_promotor"]);
                        $categoria = new Categoria($_POST["categoria"]);

                        $evento = new Evento(
                            titulo: $_POST["titulo"],
                            cep: $_POST["cep"],
                            bairro: $_POST["bairro"],
                            logradouro: $_POST["logradouro"],
                            cidade: "Jaú",
                            uf: "SP",
                            imagem: $imagemNome,
                            descricao: $_POST["descricao"],
                            situacao: "Pendente",
                            categoria: $categoria,
                            promotor: $promotor
                        );

                        for ($i = 0; $i < count($_POST["data"]); $i++) {
                            if ($_POST["data"][$i] != "") {
                                $evento->setOcorrencias(
                                    0,
                                    $_POST["data"][$i],
                                    $_POST["hora_inicio"][$i],
                                    $_POST["hora_termino"][$i]
                                );
                            }
                        }

                        $eventoDAO = new EventoDAO();
                        $retorno = $eventoDAO->inserir($evento);

                        if ($retorno) {
                            header("location:/localize-jahu/eventos?idevento=$retorno");
                            die();
                        } else {
                            unlink($diretorio . $imagemNome);
                            $mensagem = "Não foi possível cadastrar o evento!";
                        }
                    }
                }

                $categoriaDAO = new CategoriaDAO();
                $retorno = $categoriaDAO->listar();


                $titulo = ' - Cadastrar Evento';
                $style = array("assets/styles/styleEventoCadastro.css");
                $script = array("assets/scripts/scriptEventoCadastro.js");


                require_once "views/cabecalho.php";
                require_once "views/eventoCadastro.php";
                require_once "views/rodape.html";
            } else {
                header("location:/localize-jahu/cadastro-promotor");
                die();
            }
        } else {
            header("location:/localize-jahu/login");
            die();
        }
    } //fim cadastro

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

        $eventoDAO = new EventoDAO();
        $calendario = $eventoDAO->pesquisarPorMes($mes, $ano);

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

            if ($retorno[0]->situacao == "pendente") {
                if (isset($_SESSION["id_promotor"]) && $retorno[0]->id_promotor != $_SESSION["id_promotor"]) {
                    if (!isset($_SESSION["adm"]) || $_SESSION["adm"] != 'sim') {
                        header("location:/localize-jahu/pagina-nao-encontrada");
                        die();
                    }       
                }
            }

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
            header("location:/localize-jahu/eventos?idevento={$evento->getId_evento()}");
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
        if (!isset($_GET["id"])) {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }
        $evento = new Evento($_GET["id"]);
        $eventoDAO = new eventoDAO;
        $retorno = $eventoDAO->buscarUmEvento($evento);
        if ($retorno[0]->id_promotor != $_SESSION["id_promotor"]) {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }

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
                header("location:/localize-jahu/eventos?idevento={$evento->getId_evento()}&msg=$retorno");
            }
        }

        require_once "views/cabecalho.php";
        require_once "Views/editEvento.php";
        require_once "views/rodape.html";
    }

    public function autorizar_evento()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION["adm"]) || $_SESSION["adm"] != 'sim') {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }

        $titulo = ' - Autorizar Evento';
        $style = array("assets/styles/styleAutorizarEventos.css");
        $script = array();
        $eventoDAO = new eventoDAO;
        $retorno = $eventoDAO->autorizarEvento();


        require_once "views/cabecalho.php";
        require_once "Views/eventoAutorizar.php";
        require_once "views/rodape.html";
    }


    public function Pesquisar()
    {

        if ($_GET) {

            $categoria = new Categoria(id_categoria: $_GET["categoria"]);
            $evento = new Evento(titulo: $_GET["texto"], categoria: $categoria);


            $eventoDAO = new EventoDAO();
            $eventos = $eventoDAO->pesquisar($evento);
        } else {
            $eventos = null;
        }


        $titulo = ' - Pesquisar Evento';
        $style = array("assets/styles/stylePesquisar.css");
        $script = array("assets/scripts/scriptPesquisar.js");

        $categoriaDAO = new CategoriaDAO();
        $categorias = $categoriaDAO->listar();

        require_once "views/cabecalho.php";
        require_once "Views/pesquisar.php";
        require_once "views/rodape.html";
    }
}
