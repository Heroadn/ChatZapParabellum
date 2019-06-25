<?php
    if(!isset($_SESSION['Token'])) {
        header("Location:/Usuario/Login");
    }

    /** @var TYPE_NAME $id_sala */
    if($id_sala === ''){
        echo '<h3>' .'Sala não selecionada:'. '</h3>';
        echo '<p>' .'Post de messangem ficara indisponivel.'. '</p>';
    }
?>
<div class="darken">
	<div class="menssages h-80" id="boxChat">

	</div>
	<hr>
	<form class="h-20" id="formChat">
		<div class="form-group p-3 text-center">
			<div class="row">
				<div class="col-9">
					<input type="text" class="form-darken-purple" id="mensgtextarea" placeholder="Digite">
				</div>
				<div class="col-3">
					<button class="btn btn-purple purple">Enviar</button>
				</div>
			</div>
		</div>
	</form>
</div>

<script src="<?php echo JS . 'pessoas_online.js'?>"></script>

<script>
    var mensagens = [];
    var lastTimeMessageID = 1;
    var sala = <?php echo ($id_sala) ? $id_sala: '0'?>;

    var postMensagem = () => {
		console.log($('#mensagem').serialize());
		var campos = $('#mensagem').serialize();
		campos += '&para_id='+$("input[name=msg_secreta]:checked").val();
		console.log(campos);
        $.ajax({
            type: "POST",
            url: "https://chat.acid-software.net/Mensagem/cadastrar_post",
            json: campos,
            success:function (response){
                //alert(response);
            },
            error:function (jqXHR, textStatus, errorThrown){
                // Log the error to the console
                alert(
                    "The following error occurred: "+
                    textStatus, errorThrown
                );
            }
        });
    };

    var load = () => {
        document.getElementById("time").innerHTML = <?php echo "'".$time_ativo."'"?>;
        $.ajax({
            type: "GET",
            url: "https://chat.acid-software.net/Mensagem/Listar/"+ sala +"/"+lastTimeMessageID,
            contentType: 'application/json;charset=UTF-8',

            success:function (response){

                console.log(response);
				//alert(response);
                json = response;

                //Adiciona as mensagens dentro do array
                for(m in json){
                    var status = false;
                    var mensagem = {};
                    mensagem['id'] = json[m]['id'];
                    mensagem['mensagem'] = json[m]['mensagem'];
                    mensagem['json'] = json[m]['json'];
                    mensagem['usuario'] = json[m]['usuarios_id'];
                    mensagem['sala'] = json[m]['salas_id'];
					mensagem['remetente'] = json[m]['remetente'];
					mensagem['para_id'] = json[m]['para_id'];

                    if(mensagem['id'] !== lastTimeMessageID){
                        lastTimeMessageID = mensagem['id'];
						if (mensagem['para_id']){
							document.getElementById("chat").innerHTML += "<br>(Reservadamente)" +  mensagem['remetente'] + ': ' + mensagem['mensagem'];
						}
						else{
							document.getElementById("chat").innerHTML += "<br>" +  mensagem['remetente'] + ': ' + mensagem['mensagem'];
						}
                    }

                }
            }
        });
		update();
		usuarios();
    };

	function update(){
		$.get('https://chat.acid-software.net/Sala/update_usuario/<?php echo $id_sala;?>', {},
		function(data){
			})
	}

	function usuarios(){
		$.get('https://chat.acid-software.net/Sala/getUsuarios/<?php echo $id_sala;?>', {},
		function(data){
				if (data === 'b'){
					alert('TÁ BANIDO, VACILÃO!');
				}
				else {
					var Usuarios = JSON.parse(data);

					//$('#usuarios').html('');
					html = '';
					html2 = '<input type="radio" name="msg_secreta" id="0" value=""><label for="0">todos</label>';
					for (posicao in Usuarios){
						mod = <?php echo $mod ?>;
						if (mod){
							html += '<div style="width:100%; float:left"><p style="float:left; width:50%">'+Usuarios[posicao].nome+'</p><button style="float:right; width:50%" onclick="banir('+Usuarios[posicao].id+')">BANIR</button></div>';
						}
						else {
								html += '<div style="width:100%; float:left"><p style="float:left; width:50%">'+Usuarios[posicao].nome+'</p></div>';
						}
						html2 += '<input type="radio" name="msg_secreta" value="'+Usuarios[posicao].id+'"><label for="0">'+Usuarios[posicao].nome+'</label>';
					}
					if ($('#usuarios').html() != html){
						$('#usuarios').html('');
						$('#usuarios').append(html);
					}
					if ($('#enviarpara').html() != html2){
						$('#enviarpara').html('');
						$('#enviarpara').append(html2);
					}
				}
			})
	}

	function banir(id) {
		var query = 'https://chat.acid-software.net/Sala/banirUsuario/<?php echo $id_sala;?>/'+id;
		$.get(query, {},
		function(data){
			})
	};
    load();
    setInterval(load,2000);
</script>
