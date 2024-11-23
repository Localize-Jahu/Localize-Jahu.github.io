<?php
class EventoDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir(Evento $evento)
    {
        $sql = "INSERT INTO evento (descricao,
                                    titulo,
                                    logradouro,
                                    cep,
                                    bairro,
                                    cidade,
                                    uf,
                                    situacao,
                                    imagem,
                                    id_categoria,
                                    id_promotor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $evento->getDescricao());
            $stm->bindValue(2, $evento->getTitulo());
            $stm->bindValue(3, $evento->getLogradouro());
            $stm->bindValue(4, $evento->getCep());
            $stm->bindValue(5, $evento->getBairro());
            $stm->bindValue(6, $evento->getCidade());
            $stm->bindValue(7, $evento->getUf());
            $stm->bindValue(8, $evento->getSituacao());
            $stm->bindValue(9, $evento->getImagem());
            $stm->bindValue(10, $evento->getCategoria()->getID());
            $stm->bindValue(11, $evento->getPromotor()->getID());
            $stm->execute();

            $this->db = null; // Fecha a conexão
            return "Evento inserido com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }

    public function alterar(Evento $evento) {
        $sql = "UPDATE evento set descricao = ?,
                                  titulo = ?,
                                  logradouro = ?,
                                  cep = ?,
                                  bairro = ?,
                                  cidade = ?,
                                  uf = ?,
                                  imagem = ?,
                                  id_categoria = ?
                where id_evento = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $evento->getDescricao());
            $stm->bindValue(2, $evento->getTitulo());
            $stm->bindValue(3, $evento->getLogradouro());
            $stm->bindValue(4, $evento->getCep());
            $stm->bindValue(5, $evento->getBairro());
            $stm->bindValue(6, $evento->getCidade());
            $stm->bindValue(7, $evento->getUf());
            $stm->bindValue(8, $evento->getImagem());
            $stm->bindValue(9, $evento->getCategoria()->getID());
            $stm->bindValue(10, $evento->getID());
            $stm->execute();

            $this->db=null;
            return "Evento alterado com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }

    public function alterarSituacao(Evento $evento) {
        $sql = "UPDATE evento set situacao = ?
                where id_evento = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $evento->getSituacao());
            $stm->bindValue(10, $evento->getID());
            $stm->execute();

            $this->db=null;
            return "Situação alterado com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }

    // public function excluir(Evento $evento)
    // {
    //     $sql = "DELETE FROM evento where id_evento = ?";
    //     try {
    //         $stm = $this->db->prepare($sql);
    //         $stm->bindValue(1, $evento->getID());
    //         $stm->execute();
    //         $this->db=null;
    //         return "Evento excluído com sucesso!";
    //     } catch (PDOException $e) {
    //         echo "Código: " . $e->getCode();
    //         echo " .Mensagem: " . $e->getMessage();
    //     }
    // }

    public function listar()
    {
        $sql = "SELECT e.*, c.descritivo as categoria, p.nome as promotor
                FROM evento e
                INNER JOIN categoria c ON (e.id_categoria = c.id_categoria)
                INNER JOIN promotor p ON (e.id_promotor = p.id_promotor)";
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

    public function pesquisarPorId(Evento $evento) {
        $sql = "SELECT * FROM evento WHERE id_evento = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $evento->getId());
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
