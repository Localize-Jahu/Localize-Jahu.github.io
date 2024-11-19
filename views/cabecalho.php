<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="imagex/png" href="assets/images/logo_4C4452.ico">
    <link rel="stylesheet" href="assets/styles/style.css">

    <title>Localize Jahu<?php echo $titulo ?> </title>
    <?php
    foreach ($style as $href) {
        echo "<link rel='stylesheet' href='$href'>";
    }

    foreach ($script as $src) {
        echo "<script src='$src' defer></script>";
    }
    ?>