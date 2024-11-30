<main>
    <article>

        <h1>Cadastro de Promotor</h1>

<?php
    // var_dump($promotor);
?>

        <form action="/localize-jahu/cadastro-promotor" method="post">

            <div class="container">
                <label for="nome_publico">Nome Público: </label>
                <input type="text" id="nome_publico" name="nome_publico">
                <span class="asterisco">*</span>
            </div>

            <div class="container">
                <label for="email_contato">Email para contato:</label>
                <input type="email" id="email_contato" name="email_contato" oninput="validar(this)">
                <!-- <span class="asterisco">*</span> -->
            </div>

            <div class="container">
                <label for="telefone">Telefone</label>
                <input class="input-tipo" type="text" id="telefone" name="telefone" OnKeyPress="formatar('(##) ####-#####',this)" >
                <!-- <span class="asterisco">*</span> -->
            </div>

            <div class="container">
                <label for="website">Website:</label>
                <input type="url" pattern="https://.*" placeholder="https://" id="website" name="website" oninput="validar(this)">
                <!-- <span class="asterisco">*</span> -->
            </div>

            <div class="alerta">
                <span id="alerta" class="text-alerta">
                    
                </span>
            </div>

            <div class="div-bio">
                <label for="biografia" class="label-bio" >Biografia:</label>
                <textarea id="biografia" name="biografia" maxlength="5000" placeholder="Nos conte um pouco sobre você..."></textarea>
            </div>

            <div class="div-aceito">
                <input type="checkbox" name="aceito" class="input-aceito" id="aceito" required  >
                <label class="label-aceito" for="aceito">Ao confirmar o cadastro, você concorda em exibir seus dados na plataforma *.</label>
            </div>
            <div class="btns">
                <button type="submit" id="btn-submit" class="btn cadastro">Cadastrar</button>
                <a id="reset" class="btn reset">Limpar</a>
            </div>
        </form>
    </article>
</main>