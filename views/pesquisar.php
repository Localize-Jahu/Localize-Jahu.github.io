<main>
    <article>

        <form action="/localize-jahu/pesquisar" method="get">

            <div class='container column'>
                <div class="container barra">
                    <a id="opcoes" class='a-opcoes btn' href="">
                        <img class="img-opcoes" src="assets/images/search2.png" alt="">
                    </a>
                    <input type="text" id="texto" name="texto">
                    <button type="submit" class="pesquisar btn" id="pesquisar">
                        <img class="img-pesquisar" src="assets/images/search1.png" alt="">
                    </button>
                </div>

                <!-- opcoes -->

                <div id='div-categoria' class='categoria'>
                    <select name="categoria" id="categoria" d>
                        <option value="0">Escolha uma das categorias disponíveis</option>
                        <?php
                        foreach ($categorias as $dado) {
                            echo "<option value='{$dado->id_categoria}'>{$dado->descritivo}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </form>
        <?php

        // var_dump($eventos);
        ?>


    </article>
</main>