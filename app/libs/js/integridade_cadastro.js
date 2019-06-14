/* payload
*
* object{
*	"#nome": "5",
*	"#email": "a@a.com",
*	"#foto_perfil": ""
* }
*
* assert{
	"nome": "SEM_SENHA",
	"tags": "",
	"descricao": null
}
*
*/
function getJsonKeys(json){
	return Object.keys(json);
}

function getFormNames(formSerializedArray){
	names = []
	for(index in formSerializedArray){
		names.push(formSerializedArray[index].name)
	}
	return names;
}

function outer() {
	this.inner = function() {
		alert("hi");
	}
}

function Assert(json){
	this.value = '';

	this.equals = function(value){
		this.value += 'EQUALS: '+value + ";";
		return this;
	};

	this.greater = function(value){
		this.value += 'GREATER: '+value + ";";
		return this;
	};

	this.minor = function(value){
		this.value += 'MINOR: '+value + ";";
		return this;
	};

	return this.value;
}


function verifyFormIntegrity(){
	a = new Assert('').equals(1).greater(2).greater(9).greater(0);
	console.log(a.value);
	/*
	//new assert().equals(1);

	//Peguando as chaves dos formularios e os asserts
	form_keys = getFormNames($('form').serializeArray());
	assert_keys = getJsonKeys(assert);

	for(index in assert_keys){
		console.log(json[assert_keys[index]])
	}

	isTerms = $("#terms").is(':checked');
	nome =  $("#nome_usuario").val();
	senha = $("#usuario_senha").val();
	email = $("#email_usuario").val();

	if(isTerms === true && nome.length > 5 &&senha.length > 5 && email.length > 1){
		return true;
	}else{
		return false;
	}
	*/
}

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