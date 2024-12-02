<?php
class EventoDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir(Evento $evento)
    {
        $this->db->beginTransaction();
        $id_evento = 0;
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
            $id_evento = $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }

        $sql = "INSERT INTO ocorrencia (dia, hora_inicio, hora_termino, id_evento) VALUES (?, ?, ?, ?)";

        foreach ($evento->getOcorrencias() as $ocorrencia) {
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $ocorrencia->getDia());
                $stm->bindValue(2, $ocorrencia->getHoraInicio());
                $stm->bindValue(3, $ocorrencia->getHoraTermino());
                $stm->bindValue(4, $id_evento);
                $stm->execute();
            } catch (PDOException $e) {
                $this->db->rollBack();
                $this->db = null;
                echo "Código: " . $e->getCode();
                echo " .Mensagem: " . $e->getMessage();
            }
        }
        $this->db->commit();
        $this->db = null;
        return $id_evento;
    }

    public function alterarEvento(Evento $evento)
    {
        $this->db->beginTransaction();
        $sql = "UPDATE evento 
                SET descricao=?,
                    titulo=?,
                    logradouro=?,
                    cep=?,
                    bairro=?,
                    cidade=?,
                    uf=?, 
                    imagem=?,
                    id_categoria=? 
                WHERE id_evento = ?";
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
            $stm->execute();
        } catch (PDOException $e) {
            echo $e->getCode();
            echo $e->getMessage();
            die();
        }

        if ($evento->getOcorrencias() != null) {
            $sql = "INSERT INTO ocorrencia (dia, hora_inicio, hora_termino, id_evento) VALUES (?, ?, ?, ?)";

            foreach ($evento->getOcorrencias() as $ocorrencia) {
                try {
                    $stm = $this->db->prepare($sql);
                    $stm->bindValue(1, $ocorrencia->getDia());
                    $stm->bindValue(2, $ocorrencia->getHoraInicio());
                    $stm->bindValue(3, $ocorrencia->getHoraTermino());
                    $stm->bindValue(4, $evento->getId_evento());
                    $stm->execute();
                } catch (PDOException $e) {
                    $this->db->rollBack();
                    $this->db = null;
                    echo "Código: " . $e->getCode();
                    echo " .Mensagem: " . $e->getMessage();
                }
            }
        }
        $this->db->commit();
        $this->db = null;
        return $evento->getId_evento();
    }

    public function buscarUmEvento($evento)
    {
        $sql = "SELECT * 
                FROM evento e
                INNER JOIN ocorrencia o
                on (o.id_evento = e.id_evento)
                INNER JOIN categoria c ON(e.id_categoria = c.id_categoria)
                INNER JOIN promotor p ON(e.id_promotor = p.id_promotor) WHERE e.id_evento = ?";
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

    public function pesquisarId($evento)
    {
        $sql = "SELECT *
                FROM evento e
                INNER JOIN ocorrencia o
                on (o.id_evento = e.id_evento)
                INNER JOIN categoria c ON(e.id_categoria = c.id_categoria)
                INNER JOIN promotor p ON(e.id_promotor = p.id_promotor) WHERE e.id_evento = ?";
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

    public function pesquisarPorMes($mes, $ano)
    {
        $sql = 'SELECT e.id_evento, titulo, id_categoria, DAY(dia) "dia"
                FROM evento e
                INNER JOIN ocorrencia o ON (e.id_evento = o.id_evento)
                WHERE MONTH(dia) = ? AND YEAR(dia) = ? and situacao =?';
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $mes);
            $stm->bindValue(2, $ano);
            $stm->bindValue(3, 'Ativo');
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
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
            die();
        }
        $sql = 'SELECT e.imagem, e.id_evento, e.titulo, DATE_FORMAT(o.dia,"%M, %d") as dia, TIME_FORMAT(o.hora_inicio,"%H:%i") as hora_inicio, e.logradouro, e.bairro, e.cidade
            FROM evento e
            INNER JOIN ocorrencia o ON (e.id_evento = o.id_evento)
            WHERE situacao = ? AND o.dia > (CURDATE()-1)
            GROUP BY e.id_evento
            ORDER BY o.dia ASC
            LIMIT 3 ';
        try {
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
        $sql = "SELECT e.id_evento, e.titulo, e.descricao, e.imagem
                FROM evento e
                INNER JOIN ocorrencia o ON (e.id_evento = o.id_evento)
                WHERE situacao = ? AND o.dia > (CURDATE()-1)
                ORDER BY acessos DESC 
                LIMIT 3";
        try {
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

    public function autorizarEvento()
    {
        $sql = "SELECT *
                FROM EVENTO e INNER JOIN promotor p ON(p.id_promotor=e.id_promotor)
                INNER JOIN ocorrencia o ON (o.id_evento=e.id_evento) 
                WHERE situacao = ?
                GROUP BY e.id_evento
                ORDER BY o.dia ASC";

        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, 'Pendente');
            $stm->execute();
            $this->db = null;
            //retorna a forma que o banco de dados irá funcionar
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
            die();
        }
    }

    public function pesquisar(Evento $evento)
    {

        $sql = 'SET lc_time_names = ?;';
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, 'pt_BR');
            $stm->execute();
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
            die();
        }
        if ($evento->getCategoria()->getId_categoria() == 0) {
            $sql = 'SELECT e.imagem, e.id_evento, e.titulo, DATE_FORMAT(o.dia,"%M, %d") as dia, TIME_FORMAT(o.hora_inicio,"%H:%i") as hora_inicio, e.logradouro, e.bairro, e.cidade
                    FROM evento e
                    INNER JOIN ocorrencia o ON (e.id_evento = o.id_evento)
                    WHERE situacao = ? AND o.dia > (CURDATE()-1) AND e.titulo LIKE ?
                    ORDER BY o.dia ASC';
        } else {
            $sql = 'SELECT e.imagem, e.id_evento, e.titulo, DATE_FORMAT(o.dia,"%M, %d") as dia, TIME_FORMAT(o.hora_inicio,"%H:%i") as hora_inicio, e.logradouro, e.bairro, e.cidade
                    FROM evento e
                    INNER JOIN ocorrencia o ON (e.id_evento = o.id_evento)
                    WHERE situacao = ? AND o.dia > (CURDATE()-1) AND e.titulo LIKE ? AND id_categoria = ?
                    ORDER BY o.dia ASC';
        }
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, 'Ativo');
            $stm->bindValue(2, '%' . $evento->getTitulo() . '%');
            if ($evento->getCategoria()->getId_categoria() != 0) {
                $stm->bindValue(3, $evento->getCategoria()->getId_categoria());
            }
            $stm->execute();
            $this->db = null; // Fecha a conexão
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
            die();
        }
    }

    public function pesquisarOcorrencias(Evento $evento)
    {
        $sql = "SELECT * FROM ocorrencia WHERE id_evento = ? ORDER BY dia ASC";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $evento->getId_evento());
            $stm->execute();

            $this->db = null; // Fecha a conexão
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
            die();
        }
    }


    public function adicionarAcesso(Evento $evento)

    {

        $sql = "UPDATE evento
                SET acessos = acessos + 1
                WHERE id_evento = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $evento->getId_evento());
            $stm->execute();

            $this->db = null; // Fecha a conexão
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
            die();
        }

    }

    public function gerenciarEvento(Promotor $promotor)
    {
        $sql = "SELECT * FROM evento e INNER JOIN promotor p ON (p.id_promotor=e.id_promotor) inner join ocorrencia o ON (o.id_evento=e.id_evento) WHERE situacao = 'ativo' OR situacao = 'pendente' AND p.id_promotor = ?  GROUP BY e.id_evento ";
    
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $promotor->getID());
            $stm->execute();
            $this->db = null;
            //retorna a forma que o banco de dados irá funcionar
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
            die();
        }
    }

}//fecha classe
