<?php
class Rotas
{
    public array $rotas = array();

    public function get(string $nome_rota, array $dados)
    {
        $this->rotas["GET"][$nome_rota] = $dados;
    }

    public function post(string $nome_rota, array $dados)
    {
        $this->rotas["POST"][$nome_rota] = $dados;
    }

    public function verificar_rota($metodo, $nome_rota)
    {
        if (isset($this->rotas[$metodo][$nome_rota])) {
            $dados = $this->rotas[$metodo][$nome_rota];
            $method = $dados[1];
            $obj = new $dados[0]();
            return $obj->$method();
        } else {
            header("location:/localize-jahu/pagina-nao-encontrada");
            die();
        }
    }
}

$route = new Rotas();

//Inicio
$route->get("/", array(InicioController::class, "inicio"));

//Login
$route->get("/login", array(LoginController::class, "login"));
$route->post("/login", array(LoginController::class, "login"));
$route->get("/logout", array(LoginController::class, "logout"));


// Usuario
// $route->get("/cadastro", array(UsuarioController::class, "cadastrar"));
// $route->get("/recuperar-senha", array(UsuarioController::class, "recuperarSenha"));

//Sobre Nos
$route->get("/sobre-nos", array(SobreNosController::class, "inicio"));

//Contato
$route->get("/contato", array(ContatoController::class, "inicio"));

//Evento
$route->get("/evento-cadastro", array(EventoController::class, "cadastrar"));

$route->get("/evento", [EventoController::class, "listarTodos"]);
$route->post("/evento", [EventoController::class, "listarTodos"]);

$route->get("/evento1", [EventoController::class, "listar1"]);

$route->get("/alterarEvento", [EventoController::class, "alterar"]);

$route->post("/alterarEvento", [EventoController::class, "alterar"]);

$route->get("/alterarSituacao", [EventoController::class, "alterarSituacao"]);

$route->post("/calendario", array(EventoController::class, "calendario"));
$route->get("/calendario", array(EventoController::class, "calendario"));


//Erro
$route->get("/pagina-nao-encontrada", array(ErroController::class, "naoEncontrado"));
