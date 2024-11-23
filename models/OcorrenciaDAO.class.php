<?php
class OcorrenciaDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir(Ocorrencia $ocorrencia)
    {
        $sql = "INSERT INTO ocorrencia (dia,
                                        hora_inicio,
                                        hora_termino,
                                        id_evento)
                VALUES (?, ?, ?, ?)"; 
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $ocorrencia->getDia());
            $stm->bindValue(2, $ocorrencia->getHoraInicio());
            $stm->bindValue(3, $ocorrencia->getHoraTermino());
            $stm->bindValue(4, $ocorrencia->getEvento()->getID());
            $stm->execute();
            $this->db = null; // Fecha a conexão
            return "Ocorrência inserida com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }

    public function alterar(Ocorrencia $ocorrencia) {
        $sql = "UPDATE ocorrencia set dia = ?, hora_inicio = ?, hora_termino = ?, id_evento = ? where id_ocorrencia = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1,$ocorrencia->getDia());
            $stm->bindValue(2, $ocorrencia->getHoraInicio());
            $stm->bindValue(3, $ocorrencia->getHoraTermino());
            $stm->bindValue(4, $ocorrencia->getID());
            $stm->execute();

            $this->db=null;
            return "Ocorrência alterada com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }

    public function excluir(Ocorrencia $ocorrencia)
    {
        $sql = "DELETE FROM ocorrencia where id_ocorrencia = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $ocorrencia->getID());
            $stm->execute();
            $this->db=null;
            return "Ocorrência excluída com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }

    public function listar()
    {
        $sql = "SELECT * FROM ocorrencia";
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

    public function pesquisarPorIdEvento(Ocorrencia $ocorrencia) {
        $sql = "SELECT * FROM ocorrencia WHERE id_evento = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $ocorrencia->getEvento()->getID());
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
