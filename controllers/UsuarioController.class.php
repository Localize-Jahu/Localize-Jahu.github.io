<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome_completo'];
    $nome_usuario = $_POST['nome_usuario'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $ser_promotor = isset($_POST['ser_promotor']) ? 1 : 0;

    if ($senha !== $confirmar_senha) {
        die("As senhas não coincidem.");
    }

    $host = 'localhost';
    $db = 'localizejahu';
    $user = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO usuario (nome, nome_usuario, senha, telefone, email, cpf, adm) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $nome_usuario, $senha_hashed, $telefone, $email, $cpf, 0]);

        $id_usuario = $conn->lastInsertId();

        if ($ser_promotor) {
            $stmt = $conn->prepare("INSERT INTO promotor (nome_publico, telefone_contato, email_contato, condicao, id_usuario) 
                                    VALUES (?, ?, ?, ?, ?)");
            $stmt->execute(['', $telefone, $email, 1, $id_usuario]); 

            header("Location: perfil_promotor.php?id_usuario=$id_usuario");
            exit();
        }

        header("Location: dashboard.php");
        exit();
        
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "Erro: CPF, e-mail ou nome de usuário já cadastrado.";
        } else {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
