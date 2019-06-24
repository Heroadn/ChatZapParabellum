const formCriarSala = document.querySelector("#form_criar_sala")

formCriarSala.addEventListener('submit',
function(event){
	event.preventDefault()
	tagsParaEnvio = tags.toString().replace(/,/g, " ")

	if(tags.length >= 1 && $("#categoria_sala").val() != "Selecione sua Categoria" && $('#desc_new').val() != null){
		alert(`Criado sala ${$("#nome_sala").val()} com Sucesso`)

		formCriarSala.submit()
		/*
		$("#img_sala").val('')
		$("#nome_sala").val('')
		$(".new_tag_area").html("")
		tags = ""
		total = 0*/

	}else{
		alert(`Erro no Cadastro, por favor verifique seus Dados`)
	}
		$("#senha_sala").val('')
	}

)

//#nome_sala
//#desc_new
//#categoria_sala
//#senha_sala
//.img_sala
//.new_tag_area
