<main>
	<article>


		<?php
		if (isset($_GET["msg"])) {
			echo "<div class='alert alert-success' role='alert'>{$_GET["msg"]}</div>";
		}
		?>
		<h1>Eventos Pendentes</h1>
		<div class="container">

			<?php

            foreach ($retorno as $evento) {

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




		</div>
	</article>
</main>