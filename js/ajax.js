import { validaData } from './lib.js';

$(document).ready(function(){
		
    $('#btnProcessar').click(getDados);
	
	function getDados(){
	//Declaraçãoo de variáveis
		var reprocDados = document.getElementById("datareproc");
		var data = reprocDados.value;
		var result = document.getElementById("Resultado");
		var xhr = new XMLHttpRequest();
		
		
		// Iniciar uma requisição	
		//var dtform =  validaData(data);
		var dtform =  validaData(data);

		if(dtform !== false){
			//Exibe a imagem de progresso        
			result.innerHTML = '<img src="img/progresso.gif" alt="Imagem de progresso para a solicitação">';		
			
			xhr.open("GET", "php/reprocessaDia.php?datareproc=" + dtform, true);
			
			// Atribui uma função para ser executada sempre que houver uma mudança de ado
			xhr.onreadystatechange = function(){

				// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
				if (xhr.readyState == 4) {

					// Verifica se o arquivo foi encontrado com sucesso
					if (xhr.status == 200) {
						//console.log(xhr.responseText);
						result.innerHTML = xhr.responseText;
					}else{
						result.innerHTML = "Erro: " + xhr.statusText;
					}
				}
			};

			xhr.send();
		}
	}

});
