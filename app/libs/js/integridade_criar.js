function sendNewSala(){
	
	quantas_tags_tenha = contarpalavra(tags)
	
	if($("#nome_sala").val().length > 5 && quantas_tags_tenha > 2 && $("#categoria_sala").val() != "Selecione sua Categoria" && $('#desc_new').val() != null){
		$(".alert").remove()
		$(".msg_view").append(`<div class="alert alert-success" role="alert"> Criado sala ${$("#nome_sala").val()} com Sucesso </div>`)
		
		$("#img_sala").val('')
		$("#nome_sala").val('')
		$(".new_tag_area").html("")
		tags = ""
		total = 0
		
		//mandar para o bd
		
	}else{
		$(".alert").remove()
		$(".msg_view").append(`<div class="alert alert-danger" role="alert"> Erro no Cadastro, por favor verifique seus Dados </div>`)
	}
	$("#senha_sala").val('')
}

function contarpalavra(valor){         
    valor.replace(/(\r\n|\n|\r)/g," ").trim();
            
    var cont = valor.split(/\s+/g).length - 1;
	
	return cont
}
//#nome_sala
//#desc_new
//#categoria_sala
//#senha_sala
//.img_sala
//.new_tag_area