<?php
class CategoriaDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listar()
    {
        $sql = "SELECT * FROM categoria";
        try {
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null; // Fecha a conexão
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
            die();
        }
    }

    public function pesquisarPorId(Categoria $categoria) {
        $sql = "SELECT * FROM categoria WHERE id_categoria = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $categoria->getId_categoria());
            $stm->execute();
            $this->db = null; // Fecha a conexão
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
            die();
        }
    }
}
