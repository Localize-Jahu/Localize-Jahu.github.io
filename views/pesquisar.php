<main>
    <article>

        <form action="/localize-jahu/pesquisar" method="get">

            <div class='container column'>
                <label for="texto">Pesquisar:</label>
                <div class="container barra">
                    <a id="opcoes" class='a-opcoes btn' href="">
                        <img class="img-opcoes" src="assets/images/search2.png" alt="">
                    </a>
                    <input type="text" id="texto" name="texto"
                        <?php
                        if ($_GET) {
                            echo "value='{$_GET['texto']}'";
                        }
                        ?>>
                    <button type="submit" class="pesquisar btn" id="pesquisar">
                        <img class="img-pesquisar" src="assets/images/search1.png" alt="">
                    </button>
                </div>

                <!-- opcoes -->

                <div id='div-categoria' class='categoria'

                    <?php
                    if (isset($_GET['categoria']) && $_GET['categoria'] != '0') {
                        echo "style='display: block;'";
                    }
                    ?>>
                    <select name="categoria" id="categoria" d>
                        <option value="0">Escolha uma das categorias disponíveis</option>
                        <?php
                        foreach ($categorias as $dado) {
                            echo "<option value='{$dado->id_categoria}'>{$dado->descritivo}</option>";
                        }
                        ?>
                    </select>
                    <?php if ($_GET && isset($_GET['categoria'])): ?>
                        <script>
                            document.getElementById('categoria').value = '<?php echo $_GET['categoria']; ?>';
                        </script>
                    <?php endif; ?>
                </div>
            </div>
        </form>

        <div class='cards'>
            <?php

            if ($_GET) {
                if (count($eventos) === 0) {
                    echo "<h1 class='h1-titulo'>Nenhum evento encontrado!</h1>";
                } else {
                    foreach ($eventos as $evento) {

                        $imagem = $evento->imagem === NULL ? "sem-imagem.png" : $evento->imagem;
                        if (!file_exists("uploads/{$imagem}")) {
                            $imagem = "sem-imagem.png";
                        }
                        echo "
                <section class='card'>
                    <div class='card-bloco-titulo'>
                        <h2 class='card-titulo'>
                            {$evento->titulo}
                        </h2>
                        <address class='card-endereco'>
                            <p class='card-rua'>{$evento->logradouro}</p>
                            <span class='card-bairro'>{$evento->bairro}, {$evento->cidade}</span>
                        </address>
                    </div>
                    <a href='/localize-jahu/eventos?idevento={$evento->id_evento}' class='image-wrapper'>
                        <img class='card-imagem' src='uploads/{$imagem}' alt='{$evento->titulo}'>
                    </a>
                    <div class='card-data data'>
                        {$evento->dia}
                    </div>
                    <div class='card-hora hora'>
                        {$evento->hora_inicio}
                    </div>
                    <a href='/localize-jahu/eventos?idevento={$evento->id_evento}' class='card-detalhes link-saiba-mais'>SAIBA MAIS</a>
                </section>
                ";
                    }
                }
            }
            ?>
        </div>

    </article>
</main>