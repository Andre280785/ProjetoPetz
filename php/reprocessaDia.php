<?php

include("../cgi/conexaoOracle.php");

if (isset($_GET["datareproc"])){
	$dtreprocessamento = $_GET["datareproc"];
	
	//ti_atualiza_funcionarios
	
     if(empty ($dtreprocessamento)){
        echo "<script type='text/javascript'>alert('Para processar com a solicitação informe a data e clique em reprocessar!');</script>";
        $sql = "select * from TI_MONITOR_VENDAS where dif<>0 and emissao > SYSDATE - 60 order by emissao, filial";
	}else{
		
		//$stamp = strtotime(str_replace("/","-*",$dtreprocessamento));
		//$dt = date('d/m/y',$stamp);
		$ProcExecution = $conn->query("SELECT status FROM monitora_procedure a where ROWNUM < 2   order by data_ini desc");
		while($row = $ProcExecution->fetch(PDO::FETCH_OBJ)){
			foreach ($row as $item){
				if($item !== 'OK'){
					echo "
					<span class='alert'>
					    <i class='fas fa-exclamation-triangle'></i>
						Processo em execução, aguarde um momento!
					</span> <br>";					
				}else{
					$execProcedure = $conn->prepare("BEGIN ti_atualiza_monitor_andre('$dtreprocessamento'); END;");
					$execProcedure->execute();
				}
			}
		}	
		
		
		$stid  = "SELECT * from TI_MONITOR_VENDAS where dif<>0 and emissao > SYSDATE - 600 order by emissao, filial";
		$rs = $conn->query($stid);

		print "<table class='table'>\n
			<thead>\n
				<tr>\n
					<th>Emissão</th>\n
					<th>Filial</th>\n
					<th>Especie</th>\n
					<th>Valor total Zanthus</th>\n
					<th>Valor total Protheus</th>\n
					<th>Diferença</th>\n
					<th>Data de Atualização</th>\n
				</tr>\n
				<tfoot>\n
					<tr>\n
						<td colspan='7'>Os dados podem sofrer alterações caso ocorra um reprocessamento.</td>\n
					</tr>\n
				</tfoot>\n
				<tbody>\n"; // mostra como tabela

				while($row = $rs->fetch(PDO::FETCH_OBJ)){
					print "<tr>\n";
					foreach ($row as $item) {
						print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
					}
					print "</tr>\n";
				}

				print "</tbody>\n
					</thead>\n
				</table>\n"; //Finaliza a tabela
	}	  
}