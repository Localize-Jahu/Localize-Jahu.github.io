<main>
    <article>
        <h1 class="titulo1">Editar Evento</h1>
        <form method="post" action="/localize-jahu/alterarEvento" enctype="multipart/form-data">
            <input type="hidden" name="idevento" value="<?php echo $retorno[0]->id_evento; ?>">
            <input type="hidden" name="idpromotor" value="<?php echo $retorno[0]->id_promotor; ?>">
            <div class="imagem">
                <label for="imagem">Imagem: </label>
                <input type="file" name="imagem" id="imagem" onchange="mostrar(this)">
                <input type="hidden" name="imagem_antiga" value="<?php echo $retorno[0]->imagem; ?>">
                <div style="color:red;font-size:11px;"><?php echo $msg[7]; ?></div>
                <br>
                <img src="uploads/<?php echo $retorno[0]->imagem; ?>" id="img" width="170" height="100">

            </div>
            <div class="conjunto">
                <div class="titulo">
                    <label for="titulo" class="titulo">Titulo: </label>
                    <input type="text" name="titulo" id="titulo" value="<?php echo $retorno[0]->titulo; ?>">
                    <div style="color:red;font-size:11px;"><?php echo $msg[0]; ?></div>
                </div>

                <div class="logradouro">
                    <label for="logradouro" class="logradouro">Logradouro: </label>
                    <input type="text" name="logradouro" id="logradouro" value="<?php echo $retorno[0]->logradouro; ?>">
                    <div style="color:red;font-size:11px;"><?php echo $msg[2]; ?></div>
                </div>

                <div class="bairro">
                    <label for="bairro" class="bairro">Bairro: </label>
                    <input type="text" name="bairro" id="bairro" value="<?php echo $retorno[0]->bairro; ?>">
                    <div style="color:red;font-size:11px;"><?php echo $msg[4]; ?></div>
                </div>

                <div class="cidade">
                    <label for="cidade" class="cidade">Cidade: </label>
                    <input type="text" name="cidade" id="cidade" value="<?php echo $retorno[0]->cidade; ?>">
                    <div style="color:red;font-size:11px;"><?php echo $msg[5]; ?></div>
                </div>

                <div class="uf">
                    <label for="uf" class="uf">UF(Estado): </label>
                    <input type="text" name="uf" id="uf" value="<?php echo $retorno[0]->uf; ?>">
                    <div style="color:red;font-size:11px;"><?php echo $msg[6]; ?></div>
                </div>

                <div class="cep">
                    <label for="cep" class="cep">Cep: </label>
                    <input type="text" name="cep" id="cep" value="<?php echo $retorno[0]->cep; ?>">
                    <div style="color:red;font-size:11px;"><?php echo $msg[3]; ?></div>
                </div>
                <div class="descricao">
                    <label for="descricao" class="descricao">Descrição: </label>
                    <textarea name="descricao" id="descricao" cols="30" rows="10"><?php echo $retorno[0]->descricao; ?></textarea>
                    <div style="color:red;font-size:11px;"><?php echo $msg[1]; ?></div>
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
                <div id="div-clone" class="dias-ja-cadastrados">
                    <h1>Ocorrências já cadastradas</h1>
                    <?php
                    if (!empty($retorno)) {
                        foreach ($retorno as $id => $ocorrencia) {
                    ?>
                            <div class="container quebra" id="base-dia">
                                <div class="container div-dia">
                                    <label for="data<?php echo $id; ?>">Data:</label>
                                    <input type="date" name="data[<?php echo $id; ?>]" id="data<?php echo $id; ?>" value="<?php echo date('Y-m-d', strtotime($ocorrencia->dia)); ?>" onchange="desativarAlerta()">
                                </div>

                                <div class="container div-dia">
                                    <label for="hora_inicio<?php echo $id; ?>">Hora de Início:</label>
                                    <input type="time" name="hora_inicio[<?php echo $id; ?>]" id="hora_inicio<?php echo $id; ?>" value="<?php echo $ocorrencia->hora_inicio; ?>" onchange="desativarAlerta()">
                                </div>

                                <div class="container div-dia">
                                    <label for="hora_termino<?php echo $id; ?>">Hora de término:</label>
                                    <input type="time" name="hora_termino[<?php echo $id; ?>]" id="hora_termino<?php echo $id; ?>" value="<?php echo $ocorrencia->hora_termino; ?>" onchange="desativarAlerta()">
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>

                <div class="categoria">
                    <label for="categoria">Categoria:</label>
                    <select name="categoria" id="categoria">
                        <option value="0">Escolha uma categoria:</option>
                        <?php
                        $categorias = (new EventoDAO())->buscarTodasCategorias();
                        foreach ($categorias as $categoria) {
                            $selected = ($categoria->id_categoria == $retorno[0]->id_categoria) ? 'selected' : '';
                            echo "<option value='{$categoria->id_categoria}' {$selected}>{$categoria->descritivo}</option>";
                        }
                        ?>
                    </select>
                    <div style="color:red;font-size:11px;"><?php echo $msg[8]; ?></div>
                </div>
            </div>
            <input type="submit" class="button">
        </form>
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
</body>

</html>