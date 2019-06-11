function logonOn(){
	if($('#senha_login').val().length > 5){
		email_exists = true //mandar email pro banco ver se ele existe e retornar true or false
		
		senha_in_email = true //comparar senha com email cadastrado
		
		if(email_exists == true){
			if(senha_in_email == true){
				//iniciar sessao talkei
				window.location.href = "/zapzap"
			}else{
				//erro senha errada
				$(".alert").remove()
				$(".msg_view").append(`<div class="alert alert-danger text-center" role="alert"> Senha incorreta! </div>`)
			}
		}else{
			//erro de email nao existente no banco
			$(".alert").remove()
			$(".msg_view").append(`<div class="alert alert-danger text-center" role="alert"> Email não cadastrado! </div>`)
		}
	}else{
		$(".alert").remove()
		$(".msg_view").append(`<div class="alert alert-danger text-center" role="alert"> Senha incorreta! </div>`)
	}
}

//#email_login
//#senha_login