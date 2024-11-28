
<div class="content">
    <div class="container">
        <?php
        if (isset($_GET["msg"])) {
            echo "<div class='alert alert-success' role='alert'>{$_GET["msg"]}</div>";
        }
        ?>
        <h1>Eventos</h1>
            <?php
            // Loop para exibir os eventos
            foreach ($retorno as $dado) {
                echo "<tr>
                        <td><a href='/localize-jahu/eventos?idevento={$dado->id_evento}'><img src='uploads/{$dado->imagem}' width='150' height='150'></td>
                            &nbsp;&nbsp;";
                echo "</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

