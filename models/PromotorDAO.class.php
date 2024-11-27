<?php
class PromotorDAO extends UsuarioDAO 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir(Promotor $promotor)
    {
        $this->inserirUsuario($promotor);
        $sql = "INSERT INTO promotor (nome_publico,
                                    telefone_contato,
                                    email_contato,
                                    biografia,
                                    id_usuario)
                VALUES (?, ?, ?, ?, ?)";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $promotor->getNomePublico());
            $stm->bindValue(2, $promotor->getTelefoneContato());
            $stm->bindValue(3, $promotor->getEmailContato());
            $stm->bindValue(4, $promotor->getBiografia());
            $stm->bindValue(5, $promotor->getIdUsuario());
            $stm->execute();

            $this->db = null; // Fecha a conexão
            return "Promotor inserido com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }

    public function alterarPromotor(promotor $promotor) {
        $sql = "UPDATE promotor set nome_publico = ?,
                                    telefone_contato = ?,
                                    email_contato = ?,
                                    biografia = ?
                where id_promotor = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $promotor->getNomePublico());
            $stm->bindValue(2, $promotor->getTelefoneContato());
            $stm->bindValue(3, $promotor->getEmailContato());
            $stm->bindValue(4, $promotor->getBiografia());
            $stm->bindValue(5, $promotor->getId());
            $stm->execute();

            $this->db=null;
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

    public function pesquisarPorId(promotor $promotor) {
        $sql = "SELECT * FROM promotor WHERE id_promotor = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $promotor->getId());
            $stm->execute();
            $this->db = null; // Fecha a conexão
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
            die();
        }
    }

    public function pesquisarPorIdUsuario(promotor $promotor) {
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
