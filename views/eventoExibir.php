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
                <p class="subtitulo"><strong>Data:</strong> 11/08/2023 até 20/08/2023</p>
            </div>
            <div class="hora">
                <img class="imag" src="assets/images/hora.png" alt="Hora do Evento">
                <p class="subtitulo"><strong>Hora:</strong> 9:00 até 23:00</p>
            </div>

            <div class="local">
                <img class="ima" src="assets/images/local.png" alt="Local do Evento">
                <p class="subtitulo2"><strong>Local: </strong><?php echo $retorno[0]->logradouro . " - " . $retorno[0]->bairro . " , " . $retorno[0]->cidade . " - " . $retorno[0]->uf . " , " . $retorno[0]->cep; ?></p>
            </div>
            <div class="situacao">
                <p class="subtitulo"><strong>Situação: </strong><?php echo $retorno[0]->situacao; ?></p>
            </div>
            <p class="descricao"><?php echo $retorno[0]->descricao; ?></p>
            <div class="botao">
                <?php
                echo "<a href='/localize-jahu/alterarEvento?id={$retorno[0]->id_evento}' class='alterar'>Alterar</a>
              &nbsp;&nbsp;";
                if ($retorno[0]->situacao == "pendente") {
                    //cancelado
                    echo "<a href='/localize-jahu/alterarSituacao?idevento={$retorno[0]->id_evento}&situacao=cancelado' class='cancelar' onclick=\"return confirm('Confirmar o cancelamento do evento?')\">Cancelar</a>";
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