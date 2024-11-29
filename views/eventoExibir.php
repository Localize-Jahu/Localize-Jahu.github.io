<main>
    <article>
        <input type="hidden" name="imagem_antiga" value="<?php echo $retorno[0]->imagem; ?>">
        <br>
        <img src="uploads/<?php echo $retorno[0]->imagem; ?>" id="img" width="300" height="400">

        <div class="conjunto">
            <div class="titulo">
                <h1><?php echo $retorno[0]->titulo; ?> </h1>
            </div>

            <div class="data">
                <img class="imag" src="assets/images/data.png" alt="Data do Evento">
                <p class="subtitulo"><strong>Data: </strong>
                    <?php
                    // Verifica se a data está no formato esperado, e formata ela
                    $data = $retorno[0]->dia;
                    echo date('d/m/Y', strtotime($data));
                    ?>
                </p>
            </div>

            <div class="hora">
                <img class="imag" src="assets/images/hora.png" alt="Hora do Evento">
                <p class="subtitulo"><strong>Hora Início: </strong><?php echo $retorno[0]->hora_inicio; ?></p>
            </div>

            <div class="hora">
                <img class="imag" src="assets/images/hora.png" alt="Hora do Evento">
                <p class="subtitulo"><strong>Hora Término: </strong><?php echo $retorno[0]->hora_termino; ?></p>
            </div>

            <div class="local">
                <img class="ima" src="assets/images/local.png" alt="Local do Evento">
                <p class="subtitulo2"><strong>Local: </strong><?php echo $retorno[0]->logradouro . " - " . $retorno[0]->bairro . " , " . $retorno[0]->cidade . " - " . $retorno[0]->uf . " , " . $retorno[0]->cep; ?></p>
            </div>
            <div class="situacao">
                <img class="ima" src="assets/images/situacao.png" alt="Situação do Evento">
                <p class="subtitulo"><strong>Situação: </strong><?php echo $retorno[0]->situacao; ?></p>
            </div>
             <div class="categoria">
                <img class="ima" src="assets/images/categoria.png" alt="categoria do Evento">
                <p class="subtitulo"><strong>Categoria: </strong><?php echo $retorno[0]->descritivo; ?></p>
            </div> 
            <div class="promotor">
                <img class="ima" src="assets/images/promotor.png" alt="Promotor do Evento">
                <p class="subtitulo2"><strong>Promotor: </strong><?php echo "<a href='/localize-jahu/promotor?idpromotor={$retorno[0]->id_promotor}'>{$retorno[0]->nome_publico}</a>"; ?></p>
            </div>
            <p class="descricao"><?php echo $retorno[0]->descricao; ?></p>
            <div class="botao">
                <?php
                if (isset($_SESSION["adm"]) && $_SESSION["adm"] == "sim") {
                    if ($retorno[0]->situacao == "pendente") {
                        echo "<a href='/localize-jahu/alterarSituacao?idevento={$retorno[0]->id_evento}&situacao=ativo' class='alterar' onclick=\"return confirm('Confirmar a ativação?')\">Autorizar</a>";
                        echo "<a href='/localize-jahu/alterarSituacao?idevento={$retorno[0]->id_evento}&situacao=desativado' class='cancelar' onclick=\"return confirm('Confirmar a não autorização?')\">Não autorizar</a>";
                    }
                }
                ?>

                <?php
                if (isset($_SESSION["id_promotor"])) {
                    echo "<a href='/localize-jahu/alterarEvento?id={$retorno[0]->id_evento}' class='alterar'>Alterar</a>
                    &nbsp;&nbsp;";
                    if ($retorno[0]->situacao == "pendente") {
                        //cancelado
                        echo "<a href='/localize-jahu/alterarSituacao?idevento={$retorno[0]->id_evento}&situacao=cancelado' class='cancelar' onclick=\"return confirm('Confirmar o cancelamento do evento?')\">Cancelar</a>";
                    }
                }
                ?>
            </div>
        </div>
    </article>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    function mostrar(img) {
        if (img.files && img.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img')
                    .attr('src', e.target.result)
                    .width(170)
                    .height(100);
            };
            reader.readAsDataURL(img.files[0]);
        }
    }
</script>