<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localize Jahu - Cadastro</title>

    <link rel="shortcut icon" type="imagex/png" href="assets/images/logo_4C4452.ico">
    <link rel="stylesheet" href="assets/styles/styleUsuarioCadastro.css">
    <script src="assets/scripts/scriptUsuarioCadastro.js" defer></script>
</head>

<body>

    <div class="fundo"></div>
    <div class="containers">
        <a href="/localize-jahu/login" class="botao-voltar"><img src="assets/images/fechar-login.png" alt="Botão Fechar"
                class="img-fechar"></a>
        <h1>Cadastro de Usuário</h1>

        <form id="form" action="/localize-jahu/cadastro" method="post">
            <div class="erro">
                <?php
                // echo $mensagem
                ?>
            </div>
            <div class="div-input">
                <label for="nome">Nome completo:</label>
                <input id="nome" class="input-tipo input-nome" type="text" name="nome"
                    <?php
                    if (isset($usuario)) {
                        echo "value='{$usuario->getNome()}'";
                    }

                    ?>
                    required>
            </div>
            <div class="div-input">
                <label for="email">Email:</label>
                <input class="input-tipo" type="email" name="email" id='email'
                    <?php
                    if (isset($usuario)) {
                        echo "value='{$usuario->getEmail()}'";
                    }
                    ?>
                    required>

            </div>
            <?php echo "<span id='email-aviso'>{$mensagem[0]}</span>"; ?>
            <div class="div-input">
                <label for="telefone">Telefone</label>
                <input class="input-tipo" type="text" id="telefone" name="telefone" OnKeyPress="formatar('(##) ####-#####',this)" 
                <?php
                    if (isset($usuario)) {
                        echo "value='{$usuario->getTelefone()}'";
                    }
                    ?>
                required>
            </div>
            <span id="telefone-aviso">Telefone inválido!</span>
            <div class="div-input">
                <label for="cpf">CPF:</label>
                <input class="input-tipo" type="text" id="cpf" name="cpf" OnKeyPress="formatar('###.###.###-##',this)" 
                <?php
                    if (isset($usuario)) {
                        echo "value='{$usuario->getCpf()}'";
                    }
                    ?>
                required>
            </div>
            <?php echo "<span id='cpf2-aviso'>{$mensagem[1]}</span>"; ?>
            <span id="cpf-aviso">CPF inválido!</span>


            <div class="div-input">
                <label for="senha">Senha:</label>
                <input class="input-tipo" type="password" id="senha" name="senha" required>
            </div>
            <div class="div-input">
                <label for="confirmar_senha">Confirmar senha:</label>
                <input class="input-tipo" type="password" id="confirmar_senha" name="confirmar_senha" required>
            </div>
            <div class="buttons">
                <button type="submit" id="btn-submit" class="botao-acessar">Cadastrar</button>
                <a type="reset" class="botao-cadastro" id="reset">Limpar</a>
            </div>

        </form>


    </div>

</body>

</html>