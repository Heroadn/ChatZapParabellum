function sendNewUser(){
	if($("#terms").is(':checked') == true && $("#nome_usuario").val().length > 5 && $("#usuario_senha").val().length > 5 && $("#email_usuario").val().length > 1){
		$(".alert").remove()
		$(".msg_view").append(`<div class="alert alert-success" role="alert"> Cadastrado com Sucesso </div>`)
		
		$("#email_usuario").val('')
		$("#nome_usuario").val('')
		
		//mandar para o bd
		
	}else{
		$(".alert").remove()
		$(".msg_view").append(`<div class="alert alert-danger" role="alert"> Erro no Cadastro, por favor verifique </div>`)
	}
	$("#terms").prop('checked' , false)
	$("#usuario_senha").val('')
}