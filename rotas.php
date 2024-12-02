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

//Session
$route->get("/login", array(LoginController::class, "login"));
$route->post("/login", array(LoginController::class, "login"));
$route->get("/logout", array(LoginController::class, "logout"));
$route->post("/logout", array(LoginController::class, "logout"));

// Usuario
$route->get("/cadastro", array(UsuarioController::class, "cadastrar"));
$route->post("/cadastro", array(UsuarioController::class, "cadastrar"));

$route->get("/recuperar-senha", array(UsuarioController::class, "recuperarSenha"));

$route->post("/configuracoes", array(UsuarioController::class, "configuracoes"));
$route->get("/configuracoes", array(UsuarioController::class, "configuracoes"));


//Sobre Nos
$route->get("/sobre-nos", array(SobreNosController::class, "inicio"));

//Contato
$route->get("/contato", array(ContatoController::class, "inicio"));

//Evento
$route->get("/evento-cadastro", array(EventoController::class, "cadastrar"));
$route->post("/evento-cadastro", array(EventoController::class, "cadastrar"));

$route->get("/eventos", [EventoController::class, "listar"]);

$route->get("/alterarEvento", [EventoController::class, "alterar"]);
$route->post("/alterarEvento", [EventoController::class, "alterar"]);

$route->get("/alterarSituacao", [EventoController::class, "alterarSituacao"]);

$route->post("/calendario", array(EventoController::class, "calendario"));
$route->get("/calendario", array(EventoController::class, "calendario"));

$route->get("/pesquisar", array(EventoController::class, "pesquisar"));
$route->post("/pesquisar", array(EventoController::class, "pesquisar"));

//Ocorrencia

$route->get("/evento/excluir", array(OcorrenciaController::class, "excluir"));
$route->post("/evento/excluir", array(OcorrenciaController::class, "excluir"));

//autorizar eventos
$route->get("/autorizarEventos", [EventoController::class, "autorizar_evento"]);
$route->post("/autorizarEventos", [EventoController::class, "autorizar_evento"]);

$route->get("/gerenciarEventos", [EventoController::class, "gerenciar_evento"]);
$route->post("/gerenciarEventos", [EventoController::class, "gerenciar_evento"]);


//promotor
$route->get("/promotor_perfil", [PromotorController::class, "mostrar_info"]);
$route->post("/promotor_perfil", [PromotorController::class, "mostrar_info"]);
$route->get("/promotor", [PromotorController::class, "perfil_publico"]);

$route->post("/cadastro-promotor", [PromotorController::class, "cadastro"]);
$route->get("/cadastro-promotor", [PromotorController::class, "cadastro"]);

$route->get("/editar_perfil", [PromotorController::class, "alterar"]);
$route->post("/editar_perfil", [PromotorController::class, "alterar"]);




//Erro
$route->get("/pagina-nao-encontrada", array(ErroController::class, "naoEncontrado"));
