<?php
class Conexao
{
    public function __construct(protected $db = null)
    {
        $parametros = "mysql:host=localhost;dbname=localizejahu";
        try {
            $this->db = new PDO($parametros, "root", ""); // Parametros, Usuario, Senha
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo "Mensagem: " . $e->getMessage();
            die();
        }
    }
}

