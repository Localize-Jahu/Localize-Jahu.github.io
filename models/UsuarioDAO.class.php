<?php
class UsuarioDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserirUsuario(Usuario $usuario)
    {
        $sql = "INSERT INTO usuario (nome,
                                    senha, 
                                    telefone, 
                                    email, 
                                    cpf, 
                                    adm)
                VALUES (?, ?, ?, ?, ?, ?)";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $usuario->getNome());
            $stm->bindValue(2, $usuario->getSenha());
            $stm->bindValue(3, $usuario->getTelefone());
            $stm->bindValue(4, $usuario->getEmail());
            $stm->bindValue(5, $usuario->getCpf());
            $stm->bindValue(6, $usuario->isAdm());
            $stm->execute();

            $this->db = null; // Fecha a conexão
            return "Usuário inserido com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }


    public function alterarUsuario(Usuario $usuario)
    {
        $sql = "UPDATE usuario set nome = ?,
                                telefone = ?,
                                email = ?
                where id_usuario = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $usuario->getNome());
            $stm->bindValue(2, $usuario->getTelefone());
            $stm->bindValue(3, $usuario->getEmail());
            $stm->bindValue(4, $usuario->getIdUsuario());
            $stm->execute();

            $this->db = null;
            return "Usuário alterado com sucesso!";
        } catch (PDOException $e) {
            echo "Código: " . $e->getCode();
            echo " .Mensagem: " . $e->getMessage();
        }
    }
    public function login($usuario)
    {
        $sql = "SELECT * 
					FROM usuario 
					WHERE email = ?";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $usuario->getEmail());

            $stm->execute();
            $this->db = null;

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            $this->db = null;
            echo $e->getMessage();
            echo $e->getCode();
            die();
        }
    }
}
