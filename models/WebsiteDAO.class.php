<?php
class WebsiteDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir(Website $website)
    {
        $sql = "INSERT INTO website (website, id_promotor) VALUES (?, ?)";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $website->getUrl());
            $stm->bindValue(2, $website->getPromotor()->getID());
            $stm->execute();

            $this->db = null; // Fecha a conexão
            return "Website inserido com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }

    public function alterar(Website $website) {
        $sql = "UPDATE website set website = ? where id_website = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1,$website->getUrl());
            $stm->bindValue(2, $website->getID());
            $stm->execute();

            $this->db=null;
            return "Website alterado com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }

    public function excluir(Website $website)
    {
        $sql = "DELETE FROM website where id_website = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $website->getID());
            $stm->execute();

            $this->db=null;
            return "Website excluído com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }

    public function listar()
    {
        $sql = "SELECT * FROM website";
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

    public function pesquisarPorIdPromotor(Website $website) {
        $sql = "SELECT * FROM website WHERE id_promotor = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $website->getPromotor()->getID());
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
