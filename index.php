<?php
    include("cgi/conexaoOracle.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divergências de vendas</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
	<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="module" src="js/ajax.js"></script>
</head>
<body>
    <div class="principal">
        <header>
            <div class="container-header">
                <div class="logo">
                    <img src="img/logo.png" alt="Logotipo Petz">
                </div>                     
            </div>
            <nav class="menu-header">
                <ul>
                    <li>Divergências de vendas</li>
                </ul>
            </nav>   
        </header>
        <div class="container-section">
            <section>        
                <article>
                    <h1>Divergências Zanthus x Protheus</h1> 
                    <label class="data">
                        Data de Processamento:
                        <input type="date" name="datareproc" id="datareproc" min="2019-01-01" value= <?php echo date("Y-m-d"); ?> required>
                        <button id="btnProcessar" name="btnProcessar">Processar</button>
                    </label>
                        <div id="Resultado">             
							<table class="table">
								<thead>
									<tr>
										<th>Emissão</th>
										<th>Filial</th>
										<th>Especie</th>
										<th>Valor total Zanthus</th>
										<th>Valor total Protheus</th>
										<th>Diferença</th>
										<th>Data de Atualização</th>
									</tr>
									<tfoot>
										<tr>
											<td colspan="7">Os dados podem sofrer alterações caso ocorra um reprocessamento.</td>
										</tr>
									</tfoot>
									<tbody>
									<?php										
										//seleciona as diferenças coletadas no banco
										$stid  = "SELECT * from TI_MONITOR_VENDAS where dif<>0 and emissao > SYSDATE - 600 order by emissao, filial";
										$rs = $conn->query($stid);

										while($row = $rs->fetch(PDO::FETCH_OBJ)){                            
											print "<tr>\n";
											foreach ($row as $item) {
												print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
											}
											print "</tr>\n";
										}            												
									?>
									</tbody>
								</thead>
							</table> 
						</div>
                </article>        
            </section>
        </div>
        <footer class="rodape"> 
            <p>Copyright &copy; www.petz.com.br</p>
        </footer>
    </div>
	</body>
</html>