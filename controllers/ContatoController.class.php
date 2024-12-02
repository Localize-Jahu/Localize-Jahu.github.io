<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/PHPMailer.php'; 
// require 'PHPMailer/src/SMTP.php';

class ContatoController
{
    public function inicio()
    {

        // if ($_POST) {


        //     $mail = new PHPMailer(true);

        //     $mail->isSMTP();
        //     $mail->Host = 'smtp.gmail.com';
        //     $mail->SMTPAuth = true;
        //     $mail->Username = '';


        //     $to = "localizejahu@gmail.com";

        //     $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
        //     $assunto = filter_var($_POST['assunto'], FILTER_SANITIZE_STRING);
        //     $descricao = filter_var($_POST['descricao'], FILTER_SANITIZE_STRING);
        //     $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

        //     if ($nome && $assunto && $descricao && $email) {
        //         $subject = $nome . " - " . $assunto;
        //         $message = $descricao;
        //         $headers = "From: {$email}" . "\r\n" .
        //             "Reply-To: {$email}" . "\r\n" .
        //             "X-Mailer: PHP/" . phpversion();

        //         mail($to, $subject, $message, $headers);

        //         echo "<script>alert('Mensagem enviada com sucesso!');</script>";
        //         header("location:/localize-jahu/");
        //         die();
        //     } else {
        //         echo "<script>alert('Dados inválidos. Por favor, tente novamente.');</script>";
        //     }
        // }


        $titulo = ' - Contato';
        $style = array("assets/styles/styleContato.css");
        $script = array();

        require_once "views/cabecalho.php";
        require_once "views/Contato.html";
        require_once "views/rodape.html";

    }
}
