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
                            <a class="a-dropdown" href="/localize-jahu/pesquisar">Pesquisar</a>
                            <a class="a-dropdown" href="/localize-jahu/calendario">Calendário</a>

                        </div>
                    </div>
                </div>
                <?php
                $url = "login";
                $texto = "Login";
                if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {



                    $url = "logout";
                    $texto = "Sair";
                ?>
                    <div class="menu-item">
                        <div class="dropdown">
                            <a class="nav-link " href="">Gerenciar</a>
                            <div class="dropdown-content">

                                <?php
                                if (isset($_SESSION['id_promotor']) && $_SESSION['id_promotor'] != 0) {
                                ?>


                                    <a class="a-dropdown" href="evento-cadastro">Adicionar Evento</a>
                                    <a class="a-dropdown" href="/localize-jahu/promotor_perfil">Editar Perfil</a>
                                <?php
                                } else if (isset($_SESSION['adm']) && $_SESSION['adm'] == 'nao') {
                                ?>
                                    <a class="a-dropdown" href="/localize-jahu/cadastro-promotor">Vire Promotor</a>
                                <?php
                                } ?>    
                                <a class="a-dropdown" href="/localize-jahu/configuracoes">Configurações</a>
                                <?php
                                if (isset($_SESSION['adm']) && $_SESSION['adm'] == 'sim') {
                                ?>
                                    <a class="a-dropdown" href="/localize-jahu/autorizarEventos">Autorizar Eventos</a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
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
                        <a class="overlay-link" href="/localize-jahu/pesquisar  "> <img class="baixo-direita" src="assets/images/baixo-direita.png" alt=""> Pesquisar</a>
                        <a class="overlay-link" href="/localize-jahu/calendario"> <img class="baixo-direita" src="assets/images/baixo-direita.png" alt=""> Calendário</a>
                    </div>
                </div>

                <!-- promotores -->

                <?php if (isset($_SESSION['id_promotor']) && $_SESSION['id_promotor'] != 0) {

                ?>
                    <div class="celular-dropdown selecionado" id="celular-dropdown" onclick="abrirDropdown('navGerenciarDropdown');">
                        <a id="dropbtn" class="overlay-link dropbtn">Gerenciar</a>
                        <div id="navGerenciarDropdown" class="celular-dropdown-content">
                            <a class="overlay-link" href="evento-cadastro"> <img class="baixo-direita" src="assets/images/baixo-direita.png" alt="">Novo Evento</a>
                            <a class="overlay-link" href="/localize-jahu/promotor_perfil"> <img class="baixo-direita" src="assets/images/baixo-direita.png" alt="">Editar Perfil</a>
                        </div>
                    </div>
                <?php
                } else if (isset($_SESSION['adm']) && $_SESSION['adm'] == 'nao') {
                    echo '<a class="overlay-link" href="/localize-jahu/cadastro-promotor">Vire Promotor</a>';
                } else {
                ?>
                    <div class="celular-dropdown selecionado" id="celular-dropdown" onclick="abrirDropdown('navGerenciarAdmDropdown');">
                        <a id="dropbtn" class="overlay-link dropbtn">Gerenciar</a>
                        <div id="navGerenciarAdmDropdown" class="celular-dropdown-content">
                            <a class="overlay-link" href="/localize-jahu/autorizarEventos "> <img class="baixo-direita" src="assets/images/baixo-direita.png" alt=""> Autorizar Eventos</a>
                        </div>
                    </div>
                <?php
                }
                ?>
                <a class="overlay-link" href="sobreNos">Sobre Nós</a>
                <a class="overlay-link" href="contato">Contato</a>

                <?php
                if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
                    echo '<a class="overlay-link" href="/localize-jahu/configuracoes">Configurações</a>';
                    echo '<a class="overlay-link" href="/localize-jahu/logout">Sair</a>';
                }
                ?>
            </div>

        </div>

    </nav>