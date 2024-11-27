<?php

session_start();

$host = 'localhost';
$db = 'localizejahu';
$user = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    require_once 'PromotorController.php';
    $promotorController = new PromotorController($conn);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $data = [
            'nome_publico' => $_POST['nome_publico'],
            'telefone_contato' => $_POST['telefone_contato'],
            'email_contato' => $_POST['email_contato'],
            'biografia' => $_POST['biografia'],
            'condicao' => $_POST['condicao'],
            'id_usuario' => $_POST['id_usuario'],
        ];

        $validationResult = $promotorController->validate($data);

        if ($validationResult === true) {

            $promotorId = $promotorController->insert($data);
            
            header("Location: perfil_promotor.php?id=$promotorId");
            exit;
        } else {
            $promotorController->handleError($validationResult);
        }
    }
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}
?>

