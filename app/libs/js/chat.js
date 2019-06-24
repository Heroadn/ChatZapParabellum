const boxChat = document.getElementById("boxChat")
const formChat = document.getElementById("formChat")


function scrollDown(){
	$('#boxChat').animate({ scrollTop: $('#boxChat')[0].scrollHeight }, 50)
}

function createballon(typePerson, objMsg, privete = ""){
	const html = document.createElement('div')
	const msg = objMsg.mensagem //striptags(objMsg.mensagem)
	const content = `<p class="nome">${objMsg.remetente}</p><p class="text">${msg}</p>`;

	html.className = `ballon ${typePerson} ${typePerson}-${rand()} ${privete}`
	html.innerHTML = content

	boxChat.appendChild(html)
}

function rand(){
	return Math.ceil(Math.random() * 3) // random de 1 ate 3
}

function striptags(text){
	text = text.replace(/</g,"&lt;")
	text = text.replace(/>/g,"&gt;")
	return text
}

function primaryLetterUpperCase(word){
	return word = word[0].toUpperCase() + word.slice(1)
}


////////////////////////////////////
let lastTimeID = 1
const sala = 2;
const myId= 98;


formChat.addEventListener('submit', function(event){
	event.preventDefault()
	const from_id = $('#list1').value
	const privete = (from_id) ? Number(from_id) : null

	if($("#mensgtextarea").val() != ""){

		$.ajax({
			method: "POST",
			url: "https://chat.acid-software.net/Mensagem/cadastrar_post",
			data: {
				mensagem: striptags($("#mensgtextarea").val()),
				salas_id: sala,
				para_id: privete
			}
		})
			.done(function(){
				//alert(response);
				$("#mensgtextarea").val("")
			})
			.fail(function(result){
				const msnErr = `Erro: ${result.status} - ${result.statusText}
			                pro esse motivo não foi posivel enviar sua mensagem`
			})

		scrollDown()
	}
})



var load = () => {
	$.ajax({
		method: "GET",
		url: "https://chat.acid-software.net/Mensagem/Listar/2/2",
		contentType: 'application/json;charset=UTF-8'
	}).done(function(result){
		
		//Adiciona as mensagens dentro do array
		if(msgs.length != 0){
			for(m in msgs){
				let typePerson = (msgs[m].usuarios_id == myId) ? "me" : "other"
				let privete = (msgs[m].para_id != null) ? "privete" : ""

				//so nao entra se a messagem nao é minha e nao é para min e é privada
				if(!(msgs[m].usuarios_id != myId && msgs[m].para_id != myId && msgs[m].para_id != null)){
					createballon(typePerson, msgs[m], privete)
				}

			}
			msg = {
				remetente: "leandro",
				mensagem: "html heder /html "
			}

			createballon("me", msg)
			lastTimeID = msgs[msgs.length - 1].id

			scrollDown()
		}

	}).fail(function(result){
		const msnErr = `Erro: ${result.status} - ${result.statusText}`
	})


	update();
	//usuarios();
};

function update(){
	$.get('https://chat.acid-software.net/Sala/update_usuario/2', {},
		function(data){
			console.log(data)
		})
}

function usuarios(){
	$.get('https://chat.acid-software.net/Sala/getUsuarios/2', {},
		function(data){
			if (data === 'b'){
				alert('TÁ BANIDO, VACILÃO!');
			}
			else {
				var Usuarios = JSON.parse(data);

				//$('#usuarios').html('');
				html = '';
				for (posicao in Usuarios){
					mod = 0;
					if (mod){
						html += '<div style="width:100%; float:left"><p style="float:left; width:50%">'+Usuarios[posicao].nome+'</p><button style="float:right; width:50%" onclick="banir('+Usuarios[posicao].id+')">BANIR</button></div>';
					}
					else {
						html += '<div style="width:100%; float:left"><p style="float:left; width:50%">'+Usuarios[posicao].nome+'</p></div>';
					}
				}
				if ($('#usuarios').html() != html){
					$('#usuarios').html('');
					$('#usuarios').append(html);
				}
			}
		})
}

function banir(id) {
	const query = '/Sala/banirUsuario/'+sala+'/'+id;
	$.get(query, {},
		function(data){

		})
}
load()
//setInterval(load,2000);

