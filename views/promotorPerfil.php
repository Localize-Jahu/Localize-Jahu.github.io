
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

                    <div class="nome">
                            <h2>Nome Publico</h2>
                           <p><?php echo $retorno[0]->nome_publico; ?></p>    
                    </div>

                    <!-- Biografia -->
                    <div class="label-50">
                        <h2>Biografia</h2>
                        <p><?php echo $retorno[0]->biografia; ?></p>
                    </div>

                    <!-- Redes Sociais -->
                     <div class="redes-sociais">
                        <h2>Minhas Redes Sociais</h2>
                        <div class="website">
                        <h3 class="tit-website">Website</h3>
                        <p><?php echo $retorno[0]->website; ?></p>
                </div>
           
                <div class="telefone">
                <h3 class="tit-tel">Telefone</h3>
                <p><?php echo $retorno[0]->telefone_contato; ?></p>
            </div>
                <div class="email">
                <h3 class="tit-email">Email</h3>
                <p><?php echo $retorno[0]->email_contato; ?></p>
            </div>
            </div>
            

                    

                        <a href="/localize-jahu/editar_perfil">Editar</a>
                    </div>
                </form>
            </div>

            <br>
            <br>
            <br>


        </article>
    </main>
