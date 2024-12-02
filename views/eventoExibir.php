<main>
    <article>

        <?php
        $evento = $retorno[0];


        if ($evento->situacao == 'pendente') {
            $color = 'orange';
        } else if ($evento->situacao == 'ativo') {
            $color = 'green';
        } else {
            $color = 'red';
        }

        ?>

        <div class="btns">
            <?php
            if (isset($_SESSION["adm"]) && $_SESSION["adm"] == "sim") {
                if ($retorno[0]->situacao == "pendente") {
                    echo "<a href='/localize-jahu/alterarSituacao?idevento={$retorno[0]->id_evento}&situacao=ativo' class='btn btn1' onclick=\"return confirm('Confirmar a ativação?')\">Autorizar</a>";
                    echo "<a href='/localize-jahu/alterarSituacao?idevento={$retorno[0]->id_evento}&situacao=desativado' class='btn btn2' onclick=\"return confirm('Confirmar a não autorização?')\">Não autorizar</a>";
                }
            }
            ?>

            <?php
            if ($retorno[0]->situacao == "pendente") {
                if (isset($_SESSION["id_promotor"]) && $_SESSION["id_promotor"] == $retorno[0]->id_promotor) {
                    echo "<a href='/localize-jahu/alterarEvento?id={$retorno[0]->id_evento}' class='btn btn1'>Alterar</a>&nbsp;&nbsp;";
                    echo "<a href='/localize-jahu/alterarSituacao?idevento={$retorno[0]->id_evento}&situacao=cancelado' class='btn btn2' onclick=\"return confirm('Confirmar o cancelamento do evento?')\">Cancelar Evento</a>";
                }
            }
            ?>
        </div>

        <div class="container-img">
            <h1><?php
                echo $retorno[0]->titulo;

                $imagem = $evento->imagem === NULL ? "sem-imagem.png" : $evento->imagem;
                if (!file_exists("uploads/{$imagem}")) {
                    $imagem = "sem-imagem.png";
                }
                ?> </h1>
            <img class='banner' src="uploads/<?php echo $imagem; ?>" id="img" width="300" height="400">
            <div class="situacao">
                <span style='background-color: <?php echo $color ?>;'>
                    <?php echo $evento->situacao; ?>
                </span>
            </div>
        </div>
        <div class="box">

            <div class="container">
                <label for="titulo">Titulo: </label>
                <input disabled='true' type="text" name="titulo" id="titulo"

                    <?php
                    echo "value='{$evento->titulo}'";
                    ?>

                    required>
            </div>


            <div class="container">
                <label for="logradouro">Logradouro:</label>
                <input disabled='true' type="text" name="logradouro" id="logradouro"

                    <?php
                    echo "value='{$evento->logradouro}'";
                    ?>

                    required>
            </div>
            <div class="container">
                <label for="bairro">Bairro:</label>
                <input disabled='true' type="text" name="bairro" id="bairro"

                    <?php

                    echo "value='{$evento->bairro}'";

                    ?>

                    required>
            </div>


            <div class="container">
                <div class="container">
                    <label for="cidade">Cidade:</label>
                    <input disabled='true' type="text" name="cidade" id="cidade" value="Jaú" disabled style="color:white;">
                </div>

                <div class="container">
                    <label for="uf">UF:</label>
                    <input disabled='true' type="text" name="uf" id="uf" value="SP" style="color:white;" disabled>
                </div>
            </div>
            <div class="container">
                <label for="cep">CEP:</label>
                <input disabled='true' type="text" name="cep" id="cep"
                    <?php
                    echo "value='{$evento->cep}'";
                    ?>
                    required OnKeyPress="divatar('#####-###',this)">
            </div>

            <div class="container">
                <label for="promotor">Promotor:</label>
               <?php echo "<a href='/localize-jahu/promotor?idpromotor={$evento->id_promotor}' class='promotor'>"?>
                    <?php echo $evento->nome_publico; ?>
                </a>
            </div>

            <div class="container">

                <label for="categoria">Categoria:</label>
                <input type="text" disabled='true' name="categoria" id="categoria"
                    <?php
                    foreach ($retorno as $dado) {
                        echo "value='{$evento->descritivo}'";
                    }
                    ?>>
            </div>


            <div class="dias-adicionados">


                <?php
                $i = 0;
                foreach ($ocorrencias as $ocorrencia) {
                    $i++;
                    echo "<div class='container quebra'>
                            <div class='container div-dia'>
                                <label>";

                    if (count($ocorrencias) > 1) {
                        echo $i . "º ";
                    }
                    echo "Dia:</label>
                                <input disabled='true' type='date' name='dia-cadastrado[]' value='{$ocorrencia->dia}' disabled='true'>
                            </div>
                            <div class='container div-dia'>
                                <label>Hora de Início:</label>
                                <input disabled='true' type='time' name='hora-inicio-cadastrado[]' value='{$ocorrencia->hora_inicio}' disabled='true'>
                            </div>
                            <div class='container div-dia'>
                                <label>Hora de término:</label>
                                <input disabled='true' type='time' name='hora-termino-cadastrado[]' value='{$ocorrencia->hora_termino}' disabled='true'>
                            </div>
                        </div>";
                }
                ?>
            </div>
            <div class="descricao">
                <label class="label-descricao" for="descricao">Descrição:</label>

            </div>

            <textarea disabled='true' name="descricao" id="descricao" maxlength="5000" placeholder="Conte um pouco sobre o evento..."><?php echo $evento->descricao; ?></textarea>
        </div>

    </article>
</main>