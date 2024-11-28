<main>
    <article>

        <!-- Corpo -->
        <div class="corpo">

            <h1>Cadastro de Eventos</h1>

            <br>

            <!--Nome do Evento-->
            <form method="get">

                <div class="nome">
                    <h2>Nome do Evento:</h2>
                    <input type="text" name="titulo" id="titulo">
			        <div style="color:red;font-size:11px;"><?php echo $msg[0]; ?></div>
                </div>


                <!--Local do Evento-->

                <div class="local">

                    <h2>Local do Evento:</h2>
                    <div id="local">
                        <div id="local1">
                            <div id="cep">
                                <h3>CEP:</h3>
                                <input type="text" name="cep" id="cep">
			                    <div style="color:red;font-size:11px;"><?php echo $msg[1]; ?></div>
                            </div>
                            <div id="bairro">
                                <h3>Bairro:</h3>
                                <input type="text" name="bairro" id="bairro">
			                    <div style="color:red;font-size:11px;"><?php echo $msg[2]; ?></div>
                            </div>
                        </div>
                        <div id="local2">
                            <div id="logradouro">
                                <h3>Logradouro:</h3>
                                <input type="text" name="logradouro" id="logradouro">
			                    <div style="color:red;font-size:11px;"><?php echo $msg[3]; ?></div>
                            </div>

                            <div id="cidade">
                                <h3>Cidade:</h3>
                                <input type="text" name="cidade" id="cidade">
                                <div style="color:red;font-size:11px;"><?php echo $msg[4]; ?></div>
                            </div>

                            <div id="uf">
                                <h3>UF:</h3>
                                <input type="text" name="uf" id="uf">
			                    <div style="color:red;font-size:11px;"><?php echo $msg[5]; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Data do Evento-->
                <!-- <h2>Data do Evento</h2>
                <div id="data">
                    <div id="inicio-data">
                        <h3>Inicio</h3>
                        <input type="date" name="txt_data">
                    </div>
                    <div id="fim-data">
                        <h3>Fim</h3>
                        <input type="date" name="txt_data">
                    </div>
                </div> -->


                <!--Hora do Evento-->
                <!-- <h2>Hora do Evento</h2>
                <div id="hora">
                    <div id="inicio-hora">
                        <h3>Inicio</h3>
                        <input type="time" name="txt_hora">
                    </div>
                    <div id="fim-hora">
                        <h3>Fim</h3>
                        <input type="time" name="txt_hora">
                    </div>
                </div> -->


                <!--Imagem do Evento-->
                <div class="imagem">
                    <h2>Imagem do Evento</h2>
                    <!--Insira a Imagem-->
                    <input type="file" name="imagem" id="imagem" onchange="mostrar(this)">
                    <div style="color:red;font-size:11px;"><?php echo $msg[6]; ?></div>
                    <!-- Botão Enviar Imagem-->
                </div>

                <!--Descrição do Evento-->
                <div class="label-50">
                    <h2>Descrição do Evento:</h2>
                    <input type="text" name="descricao" id="descricao">
			        <div style="color:red;font-size:11px;"><?php echo $msg[7]; ?></div>
                </div>
                <br>
                <br>
                <!-- Categoria -->
                <label for="categoria">Categoria:</label>
			<select name="categoria" id="categoria">
				<option value="0">Escolha uma categoria: </option>
				<?php
				foreach ($retorno as $dado) {
					echo "<option value='{$dado->id_categoria}'>{$dado->descritivo}</option>";
				}
				?>
			</select>
			<div style="color:red;font-size:11px;"><?php echo $msg[8]; ?></div>
			<br><br>
                <!--Botão Enviar-->
                <div class="center">
                    <button type="reset">
                        Enviar
                    </button>
                </div>

                <br>

                <!--Botão Limpar-->
                <div class="center">
                    <button class="limpar" type="reset">
                        Limpar
                    </button>
                </div>



            </form>

        </div>

        <br>
        <br>
        <br>


    </article>
</main>