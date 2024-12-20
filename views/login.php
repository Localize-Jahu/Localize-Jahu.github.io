<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localize Jahu - Login</title>

    <link rel="shortcut icon" type="imagex/png" href="assets/images/logo_4C4452.ico">
    <link rel="stylesheet" href="assets/styles/styleLogin.css">
    <script src="assets/scripts/scriptLogin.js" defer></script>
</head>

<body>

    <div class="fundo"></div>
    <div class="containers">
        <div class="container-esquerda">
            <h1>Localize Jahu</h1>

            <form action="/localize-jahu/login" method="post">
                <div class="erro">
                    <?php
                    echo $mensagem
                    ?>
                </div>
                <div class="div-email">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" class="input-tipo" id="email"
                        <?php
                        echo "value='{$usuario}'";
                        ?>
                        required>
                </div>
                <div class="div-senha">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" class="input-tipo" id="senha" required>
                </div>
                <div class="div-lembrar">
                    <input type="checkbox" name="lembrar" class="input-lembrar" id="lembrar">
                    <label class="label-lembrar" for="lembrar">Lembrar de mim</label>
                </div>
                <a href="/localize-jahu/recuperar-senha" class="esqueceu-senha">Esqueceu sua senha?</a>
                <br>
                <input type="submit" value="Acessar" class="botao-acessar">

            </form>

        </div>
        <div class="container-direita">

            <a href="/localize-jahu" class="botao-voltar"><img src="assets/images/fechar-login.png" alt="Botão Fechar"
                    class="img-fechar"></a>

            <img class="logo" src="assets/images/logo_4C4452.png" alt="Logo Localize Jahu">
            <h2>Bem vindo!</h2>
            <h3>Não possui cadastro?</h3>

            <a href="cadastro" class="botao-cadastro">Cadastre-se</a>

        </div>
    </div>

</body>

</html>