<main>
    <article>

        <h1>Cadastro de Promotor</h1>


        <form action="/localize-jahu/cadastro-promotor" method="post">

            <div class="container">
                <label for="nome_publico">Nome Público:</label>
                <input type="text" id="nome_publico" name="nome_publico" required>
            </div>

            <div class="container">
                <label for="email_contato">Email para contato:</label>
                <input type="email" id="email_contato" name="email_contato" required>
            </div>

            <div class="container">
                <label for="telefone">Telefone</label>
                <input class="input-tipo" type="text" id="telefone" name="telefone" OnKeyPress="formatar('(##) ####-#####',this)" required>
            </div>

            <div class="container">
                <label for="website">Website:</label>
                <input type="text" id="website" name="website">
            </div>

            <div class="div-bio">
                <label for="biografia" class="label-bio">Biografia:</label>
                <textarea id="biografia" name="biografia" required></textarea>
            </div>
            <div class="btns">
                <button type="submit" class="btn cadastro">Cadastrar</button>
                <a id="reset" class="btn reset">Limpar</a>
            </div>
        </form>
    </article>
</main>