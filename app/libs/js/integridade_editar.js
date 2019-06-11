function sendEditSala(){
	
	quantas_tags_tenha = contarpalavra(tags_editar)
	
	if($("#nome_editar").val().length > 5 && quantas_tags_tenha > 2 && $("#categoria_editar").val() != "Selecione sua Categoria" && $("#desc_editar") != ""){
		$(".alert").remove()
		$(".alert_edit").append(`<div class="alert alert-success" role="alert"> Editada a sala ${$("#nome_sala").val()} com Sucesso </div>`)
		
		$("#img_sala").val('')
		$("#nome_sala").val('')
		$(".new_tag_area").html("")
		tags = ""
		total = 0
		
		//mandar para o bd
		
	}else{
		$(".alert").remove()
		$(".alert_edit").append(`<div class="alert alert-danger" role="alert"> Erro, por favor verifique seus Dados </div>`)
	}
	$("#senha_sala").val('')
}

function contarpalavra(valor){         
    valor.replace(/(\r\n|\n|\r)/g," ").trim();
            
    var cont = valor.split(/\s+/g).length - 1;
	
	return cont
}

//id da sala = id_sala
//#nome_editar
//#desc_editar
//#categoria_editar
//#senha_editar
//.foto_new
//.tag_add_area