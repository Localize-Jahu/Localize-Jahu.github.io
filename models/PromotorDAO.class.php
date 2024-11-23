<?php
class PromotorDAO extends UsuarioDAO 
{
    public function __construct()
    {
        parent::__construct();
    }

// 	id_promotor INT(10) AUTO_INCREMENT PRIMARY KEY,
// 	nome_publico VARCHAR(80) NOT NULL,
// 	telefone_contato VARCHAR(15),
// 	email_contato VARCHAR(80),
// 	biografia VARCHAR(800),
// 	id_usuario INT(10) NOT NULL UNIQUE,
// 	FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario)
// );

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
}
