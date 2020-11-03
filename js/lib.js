/*
 *	Formata  a data para o padrão Zanthus
 *	dd/mm/yy
 */
export function validaData(dt){
    var arr = dt.split("-");
	var dataInformada =  new Date( arr[0],(arr[1]-1),arr[2]);
	var dataAtual = new Date();
	if (dt == ""){
		alert("Data Invalida");		
		return false;
	}
	
	// Verificar se o formato da data digitada está correto		
	var patternData = /^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/;		
	if(!patternData.test(dt)){		
		alert("Data invalida, digite a data no formato Dia/Mês/Ano");			
		return false;
	}
	
	if (arr[0] > dataAtual.getFullYear() || arr[0]< 2018){
		alert("Ano invalido informe o ano entre 2018 ao ano atual");			
		return false;
	}
	if(dataInformada > dataAtual){		
		alert("A data informada é maior que a data atual.");				
		return false;
	}
	
	var dataFormatada =  arr[2] + "/" + arr[1] + "/" + arr[0].substring(2, 4);
	
	return dataFormatada;
}