<?php
class CategoriaDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir(Categoria $categoria)
    {
        $sql = "INSERT INTO categoria (descritivo) VALUES (?)";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $categoria->getDescritivo());
            $stm->execute();
            $this->db = null; // Fecha a conexão
            return "Categoria inserida com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }

    public function alterar(Categoria $categoria) {
        $sql = "UPDATE categoria set descritivo = ? where id_categoria = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1,$categoria->getDescritivo());
            $stm->bindValue(2, $categoria->getID());
            $stm->execute();
            $this->db=null;
            return "Categoria alterada com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }

    // public function excluir(Categoria $categoria)
    // {
    //     $sql = "DELETE FROM categoria where id_categoria = ?";
    //     try {
    //         $stm = $this->db->prepare($sql);
    //         $stm->bindValue(1, $categoria->getID());
    //         $stm->execute();
    //         $this->db=null;
    //         return "Categoria excluída com sucesso!";
    //     } catch (PDOException $e) {
    //         echo "Código: " . $e->getCode();
    //         echo " .Mensagem: " . $e->getMessage();
    //     }
    // }

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
            $stm->bindValue(1, $categoria->getId());
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
