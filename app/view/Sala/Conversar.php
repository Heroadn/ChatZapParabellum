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
<div id="time"></div>
<div id="chat"></div>

<form id="mensagem" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
    <br>
    <div class="form-group">
        <label for="nome"><span style="color: dodgerblue">*</span>Mensagem:</label><input class="form-control" name="mensagem" type="text">
        <input class="form-control" name="salas_id" type="hidden" value="<?php echo $id_sala;?>">
    </div>

    <div class="clearfix"></div>
</form>
<div class="text-right">
    <input type="submit" onclick="postMensagem();" class="btn btn-primary" value="Salvar">
</div>
<div>
	<a href="/Sala/sair/<?php echo $id_sala;?>"><button>Sair da sala</button></a>
	<h2>Usuários:</h2>
	<div id="usuarios" style="width:40%">
	</div>
</div>

<script>
    var mensagens = [];
    var lastTimeID = 1;
    var sala = <?php echo ($id_sala) ? $id_sala: '0'?>;

    var postMensagem = () => {
        $.ajax({
            type: "POST",
            url: "/Mensagem/cadastrar_post",
            json: $("#mensagem").serialize(),
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
            url: "/Mensagem/Listar/"+ sala +"/"+lastTimeID,
            contentType: 'application/json;charset=UTF-8',

            success:function (response){
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

                    if(mensagem['id'] !== lastTimeID){
                        lastTimeID = mensagem['id'];
                        document.getElementById("chat").innerHTML += "<br>" +  mensagem['remetente'] + ': ' + mensagem['mensagem'];
                    }

                }
            }
        });
		update();
		usuarios();
    };

	function update(){
		$.get('/Sala/update_usuario/<?php echo $id_sala;?>', {},
		function(data){
			})		
	}
	
	function usuarios(){
		$.get('/Sala/getUsuarios/<?php echo $id_sala;?>', {},
		function(data){
				if (data === 'b'){
					alert('TÁ BANIDO, VACILÃO!');
				}
				else {
					var Usuarios = JSON.parse(data);
					
					//$('#usuarios').html('');
					html = '';
					for (posicao in Usuarios){
						mod = <?php echo $mod ?>;
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
		var query = '/Sala/banirUsuario/<?php echo $id_sala;?>/'+id;
		$.get(query, {},
		function(data){
			})	
	};
    load();
    setInterval(load,2000);
	
	
</script>
