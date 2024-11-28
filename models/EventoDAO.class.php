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
            $stm->bindValue(10, $evento->getCategoria()->getId_categoria());
            $stm->bindValue(11, $evento->getPromotor()->getID());
            $stm->execute();

            $this->db = null; // Fecha a conexão
            return "Evento inserido com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }

    public function alterarEvento($evento)
    {
        $sql = "UPDATE evento set descricao=?, titulo=?, logradouro=?, cep=?, bairro=?, cidade=?, uf=?, imagem=?, id_categoria=? WHERE id_evento = ?";
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
            $stm->bindValue(9, $evento->getCategoria()->getId_categoria());
            $stm->bindValue(10, $evento->getId_evento());
            $this->db = null;
            $stm->execute();

            return "Evento alterado com sucesso!";
        } catch (PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
            die();
        }
    }

    public function buscarUmEvento($evento)
    {
        $sql = "SELECT e.*, c.id_categoria, c.descritivo, p.nome_publico, o.dia, o.hora_inicio, o.hora_termino FROM evento e INNER JOIN ocorrencia o on (o.id_evento = e.id_evento) INNER JOIN categoria c ON(e.id_categoria = c.id_categoria) INNER JOIN promotor p ON(e.id_promotor = p.id_promotor) WHERE e.id_evento = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $evento->getId_evento());
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
            die();
        }
    }
    public function buscarTodasCategorias()
    {
        $sql = "SELECT * FROM categoria";
        try {
            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
            die();
        }
    }

    public function mudarSituacao($evento)
    {
        $sql = "UPDATE evento SET situacao = ? WHERE id_evento = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $evento->getSituacao());
            $stm->bindValue(2, $evento->getId_evento());
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            $this->db = null;
            echo $e->getCode();
            echo $e->getMessage();
            die();
        }
    }


    public function pesquisarPorDia($dia, $mes, $ano)
    {
        $sql = 'SELECT e.id_evento, titulo, id_categoria
                FROM evento e
                INNER JOIN ocorrencia o ON (e.id_evento = o.id_evento)
                WHERE DAY(dia) = ? AND MONTH(dia) = ? AND YEAR(dia) = ? and situacao =?';
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $dia);
            $stm->bindValue(2, $mes);
            $stm->bindValue(3, $ano);
            $stm->bindValue(4, 'Ativo');
            $stm->execute();
            $this->db = null; // Fecha a conexão
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
            die();
        }
    }

    public function proximosEventos()
    {


        $sql = 'SET lc_time_names = ?;';
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, 'pt_BR');
            $stm->execute();

            $sql = 'SELECT e.imagem, e.id_evento, e.titulo, DATE_FORMAT(o.dia,"%M, %d") as dia, TIME_FORMAT(o.hora_inicio,"%H:%i") as hora_inicio, e.logradouro, e.bairro, e.cidade
            FROM evento e
            INNER JOIN ocorrencia o ON (e.id_evento = o.id_evento)
            WHERE situacao = ? AND o.dia > (CURDATE()-1)
            GROUP BY e.id_evento
            ORDER BY o.dia ASC
            LIMIT 3 ';

            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, 'Ativo');
            $stm->execute();
            $this->db = null; // Fecha a conexão
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
            die();
        }
    }

    public function eventosPopulares()
    {
        $sql = "SELECT id_evento, titulo, descricao, imagem
                FROM evento
                WHERE situacao = ? 
                ORDER BY ? 
                LIMIT 3";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, 'Ativo');
            $stm->bindValue(2, rand());
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
