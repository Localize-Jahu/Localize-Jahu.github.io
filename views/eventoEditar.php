<main>
    <article>

        <?php
        var_dump($evento);
        ?>

        <h1>Alterar de Eventos</h1>

        <!--Nome do Evento-->
        <form action="/localize-jahu/alterarEvento" method="post" enctype="multipart/form-data">

            <div class="container">
                <label for="titulo">Titulo: </label>
                <input type="text" name="titulo" id="titulo"

                    <?php
                    echo "value='{$evento->titulo}'";
                    ?>

                    required>
            </div>


            <div class="container">
                <label for="logradouro">Logradouro:</label>
                <input type="text" name="logradouro" id="logradouro"

                    <?php
                    echo "value='{$evento->logradouro}'";
                    ?>

                    required>
            </div>
            <div class="container">
                <label for="bairro">Bairro:</label>
                <input type="text" name="bairro" id="bairro"

                    <?php

                    echo "value='{$evento->bairro}'";

                    ?>

                    required>
            </div>
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

            <span class="alerta" id="alerta-cep">
            </span>
            <div class="container">
                <label for="cep">CEP:</label>
                <input type="text" name="cep" id="cep"

                    <?php
                    echo "value='{$evento->cep}'";
                    ?>


                    required OnKeyPress="formatar('#####-###',this)">
            </div>

            <span class="alerta" id="alerta-categoria">
            </span>
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
            <script>
                document.getElementById('categoria').value = "<?php echo $evento->id_categoria; ?>";
            </script>



            <!--Imagem do Evento-->
            <div class="container">
                <label for="imagem">Imagem:</label>
                <!--Insira a Imagem-->
                <input type="text" name="texto-imagem" id="texto-imagem"
                    <?php
                    echo "value='{$evento->imagem}'";
                    ?>
                    disabled>
                <input type="file" name="imagem" id="imagem" accept=".jpg, .png, .jpeg, .gif">
                <label for="imagem" class="botao-imagem">Selecionar Imagem</label>
                <!-- Botão Enviar Imagem-->
            </div>

            <div class="dias-adicionados">


                <?php
                foreach ($ocorrencias as $ocorrencia) {

                    echo "<div class='container quebra'>

                    <div class='container div-dia'>
                        <label>Data:</label>
                        <input type='date' name='dia-cadastrado[]' value='{$ocorrencia->dia}' disabled='true'>
                    </div>
                    <div class='container div-dia'>
                        <label>Hora de Início:</label>
                        <input type='time' name='hora-inicio-cadastrado[]' value='{$ocorrencia->hora_inicio}' disabled='true'>
                    </div>
                    <div class='container div-dia'>
                        <label>Hora de término:</label>
                        <input type='time' name='hora-termino-cadastrado[]' value='{$ocorrencia->hora_termino}' disabled='true'>
                    </div>
                    <a class='botao' onclick='confirmarExclusao({$ocorrencia->id_ocorrencia},{$evento->id_evento},{$evento->id_promotor})' >
                        <img src='assets/images/fechar-login.png' class='img-fechar'>
                        <label class='label-mais'>Remover</label>
                    </a>
                    </div>";
                }
                ?>
            </div>

            <div class="container quebra" id="base-dia">
                <div class="container div-dia">
                    <label for="data">Data:</label>
                    <input type="date" name="data[]" id="data" onchange="desativarAlerta()">
                </div>

                <div class="container div-dia">
                    <label for="hora_inicio">Hora de Início:</label>
                    <input type="time" name="hora_inicio[]" id="hora_inicio" onchange="desativarAlerta()">
                </div>
                <div class="container div-dia">
                    <label for="hora_termino">Hora de término:</label>
                    <input type="time" name="hora_termino[]" id="hora_termino" onchange="desativarAlerta()">
                </div>
                <a class="botao" id="btn-mais"><img class="img-mais" src="assets/images/fechar-login.png" alt=""><label class="label-mais">Adicionar dia</label></a>
            </div>
            <span class="alerta" id="alerta"></span>


            <div id="div-clone" class="dias-adicionados">
            </div>
            <!--Descrição do Evento-->
            <div class="div-descricao">

                <label class="label-descricao" for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" maxlength="5000" placeholder="Conte um pouco sobre o evento..."><?php echo $evento->descricao; ?></textarea>
            </div>


            <div class="btns">
                <button id="submit" class="btn cadastro" type="submit">
                    Alterar
                </button>

                <a class="reset btn" id="reset">
                    Limpar
                </a>
            </div>



        </form>
    </article>
</main>