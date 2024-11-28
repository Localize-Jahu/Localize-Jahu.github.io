
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
                <form action="/localize-jahu/editar_perfil" class="info" enctype="multipart/form-data">
                <input type="hidden" name="idpromotor" value="<?php echo $retorno[0]->id_promotor;?>">

                    <div class="nome">
                            <h2>Nome Publico</h2>
                            <input type="text" name="nome_publico" id="nome_publico" value="<?php echo $retorno[0]->nome_publico; ?>">  
                    </div>

                    <!-- Biografia -->
                    <div class="label-50">
                        <h2>Biografia</h2>
                        <input type="text" name="biografia" id="biografia" value="<?php echo $retorno[0]->biografia;?>">
                    </div>

                    <!-- Redes Sociais -->
                     <div class="redes-sociais">
                        <h2>Minhas Redes Sociais</h2>
                        <div class="website">
                        <h3 class="tit-website">Website</h3>
                        <input type="text" name="website" id="website" value="<?php echo $retorno[0]->website;?>">
                </div>
           
                <div class="telefone">
                <h3 class="tit-tel">Telefone</h3>
                <input type="text" name="telefone_contato" id="telefone" value="<?php echo $retorno[0]->telefone_contato;?>">
            </div>
                <div class="email">
                <h3 class="tit-email">Email</h3>
                input type="text" name="email_contato" id="email" value="<?php echo $retorno[0]->email_contato;?>">
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
