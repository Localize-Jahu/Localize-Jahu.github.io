<main>
    <article>


        <div class="container">
            <h2>Nome Publico</h2>

            <span><?php echo $retorno[0]->nome_publico; ?></span>
        </div>
        <?php
        if ($retorno[0]->telefone_contato != "") {
            echo "
                <div class='container'>
                    <h2>Telefone</h2>
                    <span>{$retorno[0]->telefone_contato}</span>
                </div>";
        }
        if ($retorno[0]->website == "" && $retorno[0]->email_contato == "" && $retorno[0]->biografia == "") {
            echo "
            <h3> Sem informações Adicionais </h3>
            ";
        }
        if ($retorno[0]->website != "") {
            echo "
                <div class='container'>
                    <h2>Website</h2>
                    <span>{$retorno[0]->website}</span>
                </div>
                ";
        }
        if ($retorno[0]->email_contato != "") {
            echo "
                <div class='container'>
                    <h2>Email</h2>
                    <span>{$retorno[0]->email_contato}</span>
                </div>
                ";
        }
        if ($retorno[0]->biografia != "") {
            echo "
                <div class='container'>
                    <h2>Biografia</h2>
                    <textarea>{$retorno[0]->biografia}</textarea>
                </div>
                ";
        } ?>

    </article>
</main>