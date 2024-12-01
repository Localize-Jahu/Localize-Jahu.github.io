<?php
class PromotorDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir(Promotor $promotor)
    {
        $sql = "INSERT INTO promotor (nome_publico,
                                    telefone_contato,
                                    email_contato,
                                    website,
                                    biografia,
                                    id_usuario)
                VALUES (?, ?, ?, ?, ? ,?)";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $promotor->getNomePublico());
            $stm->bindValue(2, $promotor->getTelefoneContato());
            $stm->bindValue(3, $promotor->getEmailContato());
            $stm->bindValue(4, $promotor->getWebsite());
            $stm->bindValue(5, $promotor->getBiografia());
            $stm->bindValue(6, $promotor->getIdUsuario());
            $stm->execute();

            $id_promotor = $this->db->lastInsertId();
            $this->db = null; // Fecha a conexão
            return $id_promotor;
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }

    public function alterar(promotor $promotor)
    {
        $sql = "UPDATE promotor set nome_publico = ?,
                                    telefone_contato = ?,
                                    email_contato = ?,
                                    biografia = ?,
                                    website = ?
                where id_promotor = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $promotor->getNomePublico());
            $stm->bindValue(2, $promotor->getTelefoneContato());
            $stm->bindValue(3, $promotor->getEmailContato());
            $stm->bindValue(4, $promotor->getBiografia());
            $stm->bindValue(5, $promotor->getWebsite());
            $stm->bindValue(6, $promotor->getId());
            $stm->execute();

            $this->db = null;
            return "Promotor alterado com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }

    public function listar()
    {
        $sql = "SELECT *
                FROM promotor";
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

    public function pesquisarPorIdPromotor(Promotor $promotor)
    {
        $sql = "SELECT * FROM promotor WHERE id_promotor = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $promotor->getID());
            $stm->execute();
            $this->db = null; // Fecha a conexão
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
            die();
        }
    }

    public function pesquisarPorIdUsuario(promotor $promotor)
    {
        $sql = "SELECT id_promotor FROM promotor WHERE id_usuario = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $promotor->getIdUsuario());
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
