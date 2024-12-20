<main>
    <article>

        <!-- Corpo -->
        <div class="div-titulo">
            <img src="assets/images/popular.png" alt="Icone de Popular">
            <h1 class="h1-titulo">Eventos Populares</h1>
        </div>
        <br>

        <!-- Carrossel -->


        <div id="carousel" class="carousel slide" data-ride="carousel">

            <ol class="carousel-indicators">
                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                <li data-target="#carousel" data-slide-to="1"></li>
                <li data-target="#carousel" data-slide-to="2"></li>

            </ol>
            <div class='carousel-inner'>
                <?php
                $i = 0;
                foreach ($populares as $evento) {


                    $imagem = $evento->imagem === NULL ? "sem-imagem.png" : $evento->imagem;
                    if (!file_exists("uploads/{$imagem}")) {
                        $imagem = "sem-imagem.png";
                    }


                    echo "
                        <div class='carousel-item " . ($i === 0 ? 'active' : '') . "'>
                            <a class='a-carrossel' href='/localize-jahu/eventos?idevento={$evento->id_evento}'>
                                <img class='img-carrossel' src='uploads/{$imagem}' alt='Imagem de um Evento'>
                            </a>
                            <div class='carousel-titulo'>
                                <h2>{$evento->titulo}</h2>
                                    <p>
                                        {$evento->descricao}
                                    </p>
                            </div>
                        </div>
                ";

                    $i++;
                }
                ?>


            </div> <!-- Fecha elementos dentro do carrossel -->

            <!--   Controladores | Botões -->
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span> </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>

        </div> <!-- Fim do carrossel -->
        <br>

        <!-- Cards -->

        <div class="div-titulo">
            <img src="assets/images/proximos.png" alt="Icone de Próximos">
            <h1 class="h1-titulo">Próximos Eventos</h1>
        </div>

        <div class='cards'>
            <?php

            foreach ($proximos as $evento) {

                $imagem = $evento->imagem === NULL ? "sem-imagem.png" : $evento->imagem;
                if (!file_exists("uploads/{$imagem}")) {
                    $imagem = "sem-imagem.png";
                }
                echo "

                    <section class='card'>
                        <div class='card-bloco-titulo'>
                            <h2 class='card-titulo'>
                                {$evento->titulo}
                            </h2>

                    <address class='card-endereco'>
                        <p class='card-rua'>{$evento->logradouro}</p>
                        <span class='card-bairro'>{$evento->bairro}, {$evento->cidade}</span>
                    </address>
                </div>
                <a href='/localize-jahu/eventos?idevento={$evento->id_evento}' class='image-wrapper'>
                    <img class='card-imagem' src='uploads/{$imagem}' alt='{$evento->titulo}'>
                </a>

                <div class='card-data data'>
                    {$evento->dia}
                </div>
                <div class='card-hora hora'>
                    {$evento->hora_inicio}
                </div>
                <a href='/localize-jahu/eventos?idevento={$evento->id_evento}' class='card-detalhes link-saiba-mais'>SAIBA MAIS</a>
            </section>
            ";
            }

            ?>


            <!-- <section class="card">
                <div class="card-bloco-titulo">
                    <h2 class="card-titulo">
                        4º Jahu Brew Festival
                    </h2>

                    <address class="card-endereco">
                        <p class="card-rua">
                            Rua Jordano Sanzovo 530</p>
                        <span class="card-bairro">Jardim Netinho Prado, Jaú</span>
                    </address>
                </div>
                <a href="/localize-jahu/eventos?idevento={$evento->id_evento}" class="image-wrapper">
                    <img class="card-imagem" src="assets/images/evento5.jpg" alt="Card da Expo Jahu">
                </a>

                <div class="card-data data">
                    <time datetime="2023-06-24">Junho 24, 2023</time>
                </div>
                <div class="card-hora hora">
                    <time datetime="20:00">20:00</time>
                </div>
                <a href="/localize-jahu/eventos?idevento={$evento->id_evento}" class="card-detalhes link-saiba-mais">SAIBA MAIS</a>
            </section>



            <section class="card">
                <div class="card-bloco-titulo">
                    <h2 class="card-titulo">
                        CIEJ
                    </h2>

                    <address class="card-endereco">
                        <p class="card-rua">Rua Frei Galvão 599 </p>
                        <span class="card-bairro">Jardim Pedro Ometto, Jaú</span>
                    </address>
                </div>
                <a href="/localize-jahu/eventos?idevento={$evento->id_evento}" class="image-wrapper">
                    <img class="card-imagem" src="assets/images/evento6.jpeg" alt="Card da Expo Jahu">
                </a>

                <div class="card-data data">
                    <time datetime="2023-10-19">Outubro 19, 2023</time>
                </div>
                <div class="card-hora hora">
                    <time datetime="18:00">18:00</time>
                </div>
                <a href="/localize-jahu/eventos?idevento={$evento->id_evento}" class="card-detalhes link-saiba-mais">SAIBA MAIS</a>
            </section> -->

        </div>

    </article>
</main>