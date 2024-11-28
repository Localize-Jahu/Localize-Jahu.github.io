

    <main>
        <article>

           
            <!-- conteudo do evento -->
          <div class="corpo">



     <?php
		if(isset($_GET["msg"]))
		{
			echo "<div class='alert alert-success' role='alert'>{$_GET["msg"]}</div>";
				
		}
	?>
         <h1>Eventos Pendentes</h1>
         <table class="table table-striped">
		<tr>
			
			
		</tr>
		<?php
			foreach($retorno as $dado)
			{
                echo"<th>Nome do Evento</th>
			        <th>Promotor</th>";
				echo "<tr>
				      <td><a href='/localize-jahu/eventos?idevento={$dado->id_evento}'>{$dado->titulo}</a></td>
					  <td>{$dado->id_promotor}</td>
                      <td>{$dado->nome_publico}</td>
					  <td>";			
					}//fim do foreach
		?>
	</table>
        <hr>
        <br>
          </div>
        </article>
    </main>

