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
            <a href="/localize-jahu/eventos?idevento={$evento->id_evento}">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a class="a-carrossel" href="/localize-jahu/eventos?idevento={$evento->id_evento}">
                            <img class="img-carrossel" src="assets/images/eventos.jpg" alt="Imagem de um Evento">
                        </a>
                        <div class="carousel-titulo">
                            <h2>Festival de Música e Arte</h2>
                            <p> Com apresentações ao vivo de bandas locais, exposições de arte, workshops de música
                                e pintura, o festival oferece uma plataforma para artistas emergentes e consagrados
                                mostrarem seu talento. O evento inclui também feiras gastronômicas com comidas
                                típicas e uma área dedicada às crianças, garantindo diversão para toda a família.
                            </p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <a class="a-carrossel" href="/localize-jahu/eventos?idevento={$evento->id_evento}">
                            <img class="img-carrossel" src="assets/images/evento2.jpg" alt="Imagem de um Evento">
                        </a>
                        <div class="carousel-titulo">
                            <h2>Mostra de Cinema Independente </h2>
                            <p> A Mostra de Cinema Independente de Jaú é dedicada a exibir filmes de cineastas
                                independentes de todo o Brasil. O público pode desfrutar de uma programação variada,
                                que inclui curtas e longas-metragens, documentários e animações, proporcionando uma
                                experiência cinematográfica rica e inspiradora. </p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <a class="a-carrossel" href="/localize-jahu/eventos?idevento={$evento->id_evento}">
                            <img class="img-carrossel" src="assets/images/evento3.jpg" alt="Imagem de um Evento">
                        </a>
                        <div class="carousel-titulo">
                            <h2> Noite Retrô na Discoteca Galaxy </h2>
                            <p> A Noite Retrô na Discoteca Galaxy promete uma viagem no tempo com os melhores hits
                                das décadas de 70, 80 e 90. Venha reviver os anos dourados da música dançando ao som
                                de clássicos do disco, pop e rock, com DJs renomados que farão você voltar no tempo.
                                O evento contará com decoração temática, concursos de dança e premiações para os
                                melhores trajes retrô. Uma noite de nostalgia e diversão garantida para todas as
                                idades! </p>
                        </div>
                    </div>


                </div> <!-- Fecha elementos dentro do carrossel -->

            </a>
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
                    <img class='card-imagem' src='uploads/{$evento->imagem}' alt='{$evento->titulo}'>
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