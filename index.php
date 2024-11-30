<?php
require_once "rotas.php";

//autoload das classes
spl_autoload_register(function ($nome_classe) {
    if (file_exists("controllers/" . $nome_classe . ".class.php")) {
        require_once "controllers/" . $nome_classe . ".class.php";
    } else if (file_exists("models/" . $nome_classe . ".class.php")) {
        require_once "models/" . $nome_classe . ".class.php";
    } else {
        echo "Classe não encontrada";
    }
});

// tratar a requisiçao
$nome_rota = parse_url($_SERVER["REQUEST_URI"])["path"];

$nome_rota = substr($nome_rota, strpos($nome_rota, "/", 1));

$route->verificar_rota($_SERVER["REQUEST_METHOD"], $nome_rota);
