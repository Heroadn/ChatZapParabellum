const formEditarPerfil = document.querySelector("#form_editar_perfil")

formEditarPerfil.addEventListener('submit',
function(event){
	event.preventDefault()

	if($("#senha_new").val() != ""){
		if($("#senha_new").val().length > 5 ){

			$("#senha_new").val('')
			$("#senha_old").val('')
			// bd verifica se a senha antiga bate com a do banco e atualiza e retorna TRUE OR FALSE
			senhaIsOk = true
			if(senhaIsOk == true){
				openBox('done', `Senha editada com sucesso`)
				//salvar no banco
			}else{
				openBox('err', `Erro na sua senha atual esta errada`)
			}
		}else{
				openBox('err', `A nova senha precisa ter ao menos 5 caracteres `)
				$("#senha_new").val('')
				$("#senha_old").val('')
			}
	}
	if($("#trocar_nome").val() != ""){
		if( $("#trocar_nome").val().length > 5 ){
			openBox('done', `Nome editado com sucesso`)

			// mandar para o bd

		}else{
			openBox('err', `O novo nome precisa ter ao menos 5 caracteres`)
		}
	}
})
