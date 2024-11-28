<?php

echo "<pre>";
var_dump($retorno);
echo "</pre>";

?>
<main>
        <article>

            <!-- Corpo -->
            <div class="corpo">
                <h1>Meu Perfil</h1>

                <br>

                  <!--Imagem Perfil-->     
                <!-- <div class="foto">
                    <input type="image" id="imagem">
                </div> -->

               
                <!--Nome Publico-->
                <form action="/localize-jahu/promotor_perfil" class="info" enctype="multipart/form-data">
                <input type="hidden" name="idpromotor" value="<?php echo $retorno->id_promotor;?>" >

                    <div class="nome">
                            <h2>Nome Publico</h2>
                           <p><?php echo $retorno->nome_publico; ?></p>    
                    </div>

                    <!-- Biografia -->
                    <div class="label-50">
                        <h2>Biografia</h2>
                        <p><?php echo $retorno->biografia; ?></p>
                    </div>

                    <!-- Redes Sociais -->
                     <div class="redes-sociais">
                        <h2>Minhas Redes Sociais</h2>
                        <div class="website">
                        <h3 class="tit-website">Website</h3>
                        <p><?php echo $retorno->website; ?></p>
                </div>
           
                <div class="telefone">
                <h3 class="tit-tel">Telefone</h3>
                <p><?php echo $retorno->telefone_contato; ?></p>
            </div>
                <div class="email">
                <h3 class="tit-email">Email</h3>
                <p><?php echo $retorno->email_contato; ?></p>
            </div>
            </div>
            

                        <!--Botão Enviar-->
                        <!-- <div class="center">
                            <h2>Deseja desativar seu perfil de Promotor?</h2>
                            <button type="reset">
                                Desativar Perfil Promotor 
                            </button>
                        </div> -->

                        <!--Botão Gerenciar Eventos-->
                        <!-- <h2>Gerenciar Eventos</h2>
                        <div class="gerenciar">
                        <div class="criar">
                            <button class="criare" type="reset">
                                Criar Eventos
                            </button>
                        </div>

                        <div class="editar">
                            <button class="editar" type="reset">
                                Editar Eventos
                            </button>
                        </div>

                    </div> -->
                </form>
            </div>

            <br>
            <br>
            <br>


        </article>
    </main>
