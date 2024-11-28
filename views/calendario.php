<main>
    <article>

        <?php

        $meses = [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro'
        ];

        $corClasse = [
            1 => "festa",  
            2 => "show",
            3 => "festival",
            4 => "exposicao",
            5 => "encontro",
            6 => "feira",
            7 => "workshop-oficina",
            8 => "curso",
            9 => "esportivo",
            10 => "competicao",
            11 => "caminhada-corrida",
            12 => "palestra",
            13 => "religioso",
            14 => "evento-academico",
            15 => "palestra-seminario"
        ];

        $primeiroDia = mktime(0, 0, 0, $mes, 1, $ano);

        $mesTemporario = $mes;
        $anoTemporario = $ano;

        echo "<div class='titulo'>
            <a href='/localize-jahu/calendario?mes=";
        if ($mesTemporario == 1) {
            $mesTemporario = 12;
            $anoTemporario = $anoTemporario - 1;
        } else {
            $mesTemporario = $mesTemporario - 1;
        }



        echo $mesTemporario . "&ano=" . $anoTemporario . "'>
            <img class='seta' src='assets/images/esquerda.png' alt=''>
            </a>
            <h1>
                " . $meses[$mes] . " de " . $ano . "
            </h1>
            <a href='/localize-jahu/calendario?mes=";

        $mesTemporario = $mes;
        $anoTemporario = $ano;

        if ($mesTemporario == 12) {
            $mesTemporario = 1;
            $anoTemporario++;
        } else {
            $mesTemporario++;
        }

        echo $mesTemporario . "&ano=" . $anoTemporario . "'>
            <img class='seta' src='assets/images/direita.png' alt=''>
            </a></div>

            ";


        // definir o número de dias no mês
        $numDias = date('t', $primeiroDia);

        // criar um array com os dias da semana
        $diasSemana = array('DOM', 'SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB');

        // criar o calendário
        echo '<table class="calendario borda">';
        echo '<tr>';
        foreach ($diasSemana as $dia) {
            echo '<th class="nome-dia borda">' . $dia . '</th>';
        }
        echo '</tr><tr class="semana">';

        // criar as linhas do calendário
        for ($i = 1; $i <= $numDias; $i++) {
            if ($i == 1) {
                // calcular o número de células vazias antes do primeiro dia
                $celulasVazias = date('w', $primeiroDia);
                for ($j = 0; $j < $celulasVazias; $j++) {
                    echo '<td class="dia borda"></td>';
                }
            }
            echo '
                <td class="dia borda">
                <div class="numero-dia">
                    ' . $i . '
                </div>
                <div class="eventos">
                ';

                
                $eventoDAO = new EventoDAO();
            $evento = $eventoDAO->pesquisarPorDia($i, $mes, $ano);



            if (count($evento) > 0) {
                $z = 0;
                while ($z < count($evento) && $z < 3) {
                    echo "
                        <a href='/localize-jahu/eventos?idevento={$evento[$z]->id_evento}' class='evento {$corClasse[$evento[$z]->id_categoria]}'>
                            {$evento[$z]->titulo}
                        </a>
                    ";
                    $z++;
                }
                if (count($evento) > 3) {
                    echo '
                        <a href="#" class="eventos-outros">
                        <div class="outros">
                            + ' . (count($evento) - 3) . '
                        </div>    
                        </a>
                    ';
                }
            }

            echo '
                </div>
            </td>
            ';
            if ((($i + $celulasVazias) % 7 == 0) and ($i < $numDias)) {
                echo '</tr><tr class="semana">';
            }
        }
        echo '</tr>';
        echo '</table>';
        ?>

    </article>
</main>