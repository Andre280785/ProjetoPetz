<?php
    require_once("cgi/conexaoOracle.php");
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
    <div>
               
        <header class="principal">
            <div class="container-header">
                <div class="logo">
                    <img src="img/logo.png" alt="Logotipo Petz">
                </div>                     
            </div>
            <div class="filtro">
                <label class="label">
                    Data inicial: 
                    <input type="date" class="dt" name="dataInicial" id="dataInicial" value= <?php echo date("Y-m-d"); ?> required>
                </label>
                <label class="label">
                    Data final: 
                    <input type="date" class="dt" name="datafinal" id="datafinal" value= <?php echo date("Y-m-d"); ?> required>
                </label>
                <label class="label">
                    Filial: 
                    <select name="filial" class="slect">
                        <option value='TODAS' selected>Todas</option>\n
                        <?php 
                            $filiais  = "select cod_protheus from ti_filiais where cod_protheus not in('01 0008','02 0004','02 0004','02 0004') ORDER BY cod_protheus";
                            $rs = $conn->query($filiais);

                            while($row = $rs->fetch(PDO::FETCH_OBJ)){                                 
                                foreach ($row as $item) {
                                    print "<option value='" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "'>"
                                    .($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;"). "</option>\n";
                                }                               
                            }            		
                        ?>
                    </select>
                </label>
                <label class="label">
                    Especie: 
                    <select name="especie" class="slect">
                        <option value="TODAS" selected>Todas</option>                        
                        <option value="NFS">NFS</option>
                        <option value="SPED">SPED</option>
                        <option value="CF">CF</option>
                        <option value="SATCE">SATCE</option>
                        <option value="NFCE">NFCE</option>
                    </select>
                </label>
                <button id="btnConsult" name="btnConsult" class="botao">Consultar</button>
            </div>   
        </header>        
        <div class="container-section">
            <section>        
                <article>
                    <h1>Divergências Zanthus x Protheus</h1> 
                    <label class="data">
                        Data de Processamento:
                        <input type="date" class="dt" name="datareproc" id="datareproc" min="2019-01-01" value= <?php echo date("Y-m-d"); ?> required>
                        <button id="btnProcessar" name="btnProcessar" class="botao">Processar</button>
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