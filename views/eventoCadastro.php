<main>
    <article>
        <h1>Cadastro de Eventos</h1>

        <!--Nome do Evento-->
        <form action="/localize-jahu/evento-cadastro" method="post">


            <div class="container">
                <label for="titulo">Titulo: </label>
                <input type="text" name="titulo" id="titulo" required>
            </div>

            <div class="container">
                <label for="cep">CEP:</label>
                <input type="text" name="cep" id="cep" required OnKeyPress="formatar('#####-###',this)">
            </div>

            <div class="container">
                <label for="bairro">Bairro:</label>
                <input type="text" name="bairro" id="bairro" required>
            </div>

            </div>
            <div class="container">
                <label for="logradouro">Logradouro:</label>
                <input type="text" name="logradouro" id="logradouro" required>
            </div>

            <div class="container">
                <div class="container">
                    <label for="cidade">Cidade:</label>
                    <input type="text" name="cidade" id="cidade" value="Jaú" disabled style="color:white;">
                </div>

                <div class="container">
                    <label for="uf">UF:</label>
                    <input type="text" name="uf" id="uf" value="SP" style="color:white;" disabled>
                </div>
            </div>

            <!-- Categoria -->
            <div class="container">
                <label for="categoria">Categoria:</label>
                <select name="categoria" id="categoria">
                    <option value="0">Escolha uma das categorias disponíveis</option>
                    <?php
                    foreach ($retorno as $dado) {
                        echo "<option value='{$dado->id_categoria}'>{$dado->descritivo}</option>";
                    }
                    ?>
                </select>
            </div>




            <!--Imagem do Evento-->
            <div class="container">
                <label for="imagem">Imagem:</label>
                <!--Insira a Imagem-->
                <input type="text" name="texto-imagem" id="texto-imagem" disabled>
                <input type="file" name="imagem" id="imagem" accept=".jpg, .png, .jpeg, .gif">
                <label for="imagem" class="botao-imagem">Selecionar Imagem</label>
                <!-- Botão Enviar Imagem-->
            </div>

            <!--Descrição do Evento-->
            <div class="div-descricao">

                <label class="label-descricao" for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" placeholder="Conte um pouco sobre o evento..."></textarea>
            </div>


            <div class="btns">
                <button class="btn cadastro" type="submit">
                    Cadastrar
                </button>

                <a class="reset btn" id="reset">
                    Limpar
                </a>
            </div>



        </form>
    </article>
</main>