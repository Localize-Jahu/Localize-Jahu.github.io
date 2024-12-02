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

                        if (file_exists($diretorio . $imagemNome)) {
                            unlink($diretorio . $imagemNome);
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

        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_GET["idevento"])) {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }

        if (isset($_GET["idevento"])) {
            $evento = new Evento($_GET["idevento"]);
            $eventoDAO = new eventoDAO;
            $retorno = $eventoDAO->buscarUmEvento($evento);
            $evento = $retorno[0];
            $event = new Evento($_GET["idevento"]);
            $eventoDAO = new EventoDAO();
            $ocorrencias = $eventoDAO->pesquisarOcorrencias($event);



            if (count($retorno) == 0) {
                header("location:/localize-jahu/pagina-nao-encontrada");
                die();
            }

            if (!isset($_SESSION["id_promotor"]) && (!isset($_SESSION["adm"]))) {
                if ($retorno[0]->situacao == "pendente") {
                    header("location:/localize-jahu/pagina-nao-encontrada");
                    die();
                }
            }


            if ($retorno[0]->situacao == "pendente") {
                if (isset($_SESSION["id_promotor"]) && $retorno[0]->id_promotor != $_SESSION["id_promotor"]) {
                    header("location:/localize-jahu/pagina-nao-encontrada");
                    die();
                }
            }


            self::adicionarAcesso($evento->id_evento);

            $titulo = ' - ' . $evento->titulo;
            $style = array("assets/styles/styleEventoExibir.css");
            $script = array();
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

                if (file_exists($diretorio . $imagemNome)) {
                    unlink($diretorio . $imagemNome);
                }
                if (!file_exists($diretorio . $imagemNome)) {
                    if (!move_uploaded_file($_FILES["imagem"]["tmp_name"], $diretorio . $imagemNome)) {
                        $mensagem = "Erro ao fazer upload da imagem!";
                        $erro = true;
                    }
                }
            } else {
                if (file_exists($diretorio . $_POST["texto-imagem"])) {
                    $imagemNome = $_POST["texto-imagem"];
                } else {
                    $imagemNome = "sem-imagem.png";
                }
            }

            if (!$erro) {

                $categoria = new Categoria($_POST["categoria"]);

                $evento = new Evento(
                    id_evento: $_POST["id_evento"],
                    titulo: $_POST["titulo"],
                    cep: $_POST["cep"],
                    bairro: $_POST["bairro"],
                    logradouro: $_POST["logradouro"],
                    cidade: "Jaú",
                    uf: "SP",
                    imagem: $imagemNome,
                    descricao: $_POST["descricao"],
                    categoria: $categoria
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
                $retorno = $eventoDAO->alterarEvento($evento);

                echo $retorno;

                if ($retorno) {
                    header("location:/localize-jahu/eventos?idevento=" . $evento->getId_evento());
                    die();
                } else {
                    unlink($diretorio . $imagemNome);
                    $mensagem = "Não foi possível cadastrar o evento!";
                }
            }
        }

        if (!isset($_GET["id"])) {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }

        $evento = new Evento($_GET["id"]);
        $eventoDAO = new eventoDAO;
        $retorno = $eventoDAO->pesquisarId($evento);

        if (count($retorno) == 0) {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }

        $evento = $retorno[0];

        if ($evento->id_promotor != $_SESSION["id_promotor"]) {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }
        if ($evento->situacao == "ativo") {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }

        $event = new Evento($_GET["id"]);
        $eventoDAO = new EventoDAO();
        $ocorrencias = $eventoDAO->pesquisarOcorrencias($event);




        $categoriaDAO = new CategoriaDAO();
        $retorno = $categoriaDAO->listar();



        $titulo = ' - Alterar Evento';
        $style = array("assets/styles/styleEventoEditar.css");
        $script = array("assets/scripts/scriptEventoEditar.js");


        require_once "views/cabecalho.php";
        require_once "Views/eventoEditar.php";
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
        $style = array("assets/styles/styleEventoAutorizar.css");
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


    private static function armazenarAcessos(array $ids_evento)
    {
        $validade = strtotime("+1 day");
        $ids_evento_str = implode(",", $ids_evento);
        setcookie(
            "eventos_acessados",
            $ids_evento_str,
            $validade,
            "/",
            "",
            false,
            true
        );
    }

    private static function adicionarAcesso($id_evento)
    {
        if (isset($_COOKIE["eventos_acessados"])) {
            $eventos_acessados = explode(",", $_COOKIE["eventos_acessados"]);
            if (in_array($id_evento, $eventos_acessados)) {
                return;
            }
            self::armazenarAcessos(array_merge($eventos_acessados, array($id_evento)));
        } else {
            self::armazenarAcessos(array($id_evento));
        }
        $evento = new Evento(id_evento: $id_evento);
        $eventoDAO = new EventoDAO();
        $eventoDAO->adicionarAcesso($evento);
    }

    public function gerenciar_evento()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION["adm"]) || $_SESSION["adm"] != 'sim') {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }

        $titulo = ' - Autorizar Evento';
        $style = array("assets/styles/styleEventoAutorizar.css");
        $script = array();
        $eventoDAO = new eventoDAO;
        $retorno = $eventoDAO->gerenciarEvento();


        require_once "views/cabecalho.php";
        require_once "Views/eventoAutorizar.php";
        require_once "views/rodape.html";
    }
}
