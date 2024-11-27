<?php
if (!isset($_SESSION)) {
    session_start();
}
// var_dump($_SESSION);
?>
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
</head>

<body>
    <div class="fundo"></div>

    <nav>
        <div class="nav-container">
            <div class="nav-logo">
                <a href="/localize-jahu/" class="a-logo">
                    <img src="assets/images/logo_4C4452.png" alt="Logo da Localize Jahu">
                </a>
            </div>
            <div class="menu">
                <div class="menu-item">
                    <a class="nav-link " href="/localize-jahu/">Home</a>
                </div>
                <div class="menu-item">
                    <div class="dropdown">
                        <a class="nav-link" href="">Eventos</a>
                        <div class="dropdown-content">
                            <a href="#">Pesquisar</a>
                            <a href="/localize-jahu/calendario">Calendário</a>

                        </div>
                    </div>
                </div>
                <?php
                if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
                    if (isset($_SESSION['id_promotor']) && $_SESSION['id_promotor'] != 0) {

                        echo '
                        <div class="menu-item">
                            <div class="dropdown">
                                <a class="nav-link " href="">Promotores</a>
                                <div class="dropdown-content">
                                    <a href="evento-cadastro">Adicionar Evento</a>
                                    <a href="#">Editar Perfil</a>
                                </div>
                            </div>
                        </div>
                        ';
                    }


                    $url = "";
                    $texto = "";

                    $url = "logout";
                    $texto = "Sair";
                } else {
                    $url = "login";
                    $texto = "Login";
                }

                echo '
                        <div class="menu-item">
                            <a class="nav-login" href="' . $url . '">' . $texto . '</a>
                        </div>
                        ';
                ?>
            </div>
            <div class="menu-icon">
                <a href="#" class="menu-abrir" id="menu-abrir" onclick="abrirNav();">
                    <img src="assets/images/menu.png" alt="Icone de Menu">
                </a>
                <a href="javascript:void(0)" class="menu-fechar" id="menu-fechar" onclick="fecharNav();"><img
                        src="assets/images/fechar.png" alt=""></a>
            </div>
        </div>


        <!-- Menu Celular -->
        <div id="navCelular" class="overlay">

            <div class="overlay-conteudo">
                <a class="overlay-link" href="/localize-jahu/">Home</a>
                <?php
                if (!isset($_SESSION['logado'])) {
                    echo '<a class="overlay-link" href="login">Login</a>';
                }
                ?>
                <!-- eventos -->

                <div class="celular-dropdown selecionado" id="celular-dropdown" onclick="abrirDropdown('navEventosDropdown');">
                    <a id="dropbtn" class="overlay-link dropbtn">Eventos</a>
                    <div id="navEventosDropdown" class="celular-dropdown-content overlay-link">
                        <a class="overlay-link" href="#"> <img class="baixo-direita" src="assets/images/baixo-direita.png" alt=""> Pesquisar</a>
                        <a class="overlay-link" href="/localize-jahu/calendario"> <img class="baixo-direita" src="assets/images/baixo-direita.png" alt=""> Calendário</a>
                    </div>
                </div>

                <!-- promotores -->

                <?php if (isset($_SESSION['id_promotor']) && $_SESSION['id_promotor'] != 0) {

                ?>
                    <div class="celular-dropdown selecionado" id="celular-dropdown" onclick="abrirDropdown('navPromotorDropdown');">
                        <a id="dropbtn" class="overlay-link dropbtn">Promotores</a>
                        <div id="navPromotorDropdown" class="celular-dropdown-content">
                            <a class="overlay-link" href="evento-cadastro"> <img class="baixo-direita" src="assets/images/baixo-direita.png" alt="">Novo Evento</a>
                            <a class="overlay-link" href="#"> <img class="baixo-direita" src="assets/images/baixo-direita.png" alt="">Editar Perfil</a>
                        </div>
                    </div>
                <?php
                }
                ?>
                <a class="overlay-link" href="sobreNos">Sobre Nós</a>
                <a class="overlay-link" href="contato">Contato</a>

                <?php
                if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
                    echo '<a class="overlay-link" href="logout">Sair</a>';
                }
                ?>
            </div>

        </div>

    </nav>