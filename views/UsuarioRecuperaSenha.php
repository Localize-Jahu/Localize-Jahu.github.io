</main>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localize Jahu - Cadastro</title>

    <link rel="shortcut icon" type="imagex/png" href="assets/images/logo_4C4452.ico">
    <link rel="stylesheet" href="assets/styles/styleUsuarioRecuperarSenha.css">
    <!-- <script src="assets/scripts/scriptUsuarioRecuperarSenha.js" defer></script> -->
</head>

<body>

    <main>
        <article>
            <div class="fundo"></div>
            <div class="containers">
                <div class="topo">
                
                <h1 class="titulo">Redefinir Senha</h1>    
                <a href="/localize-jahu/login" class="botao-voltar"><img src="assets/images/fechar-login.png" alt="Botão Fechar"
                            class="img-fechar"></a>
                </div>
                <div class="container">

                    <form id="form" action="/localize-jahu/login" method="post">
                        <div class="esqueceu">
                            <p class="texto">Preencha o seu email abaixo para solicitar a recuperação de senha.</p>
                            <div class="div-input">
                                <label for="email">Email:</label>
                                <input id="email" class="input-tipo input-email" type="email" name="email" required>

                            </div>
                            <p class="texto">Você receberá um email no endereço informado para continuar a redefinir sua senha.</p>
                            <div class="buttons">
                                <input class="btn" type="submit" value="Enviar">
                            </div>
                    </form>
                </div>
            </div>
        </article>
    </main>
</body>

</html>