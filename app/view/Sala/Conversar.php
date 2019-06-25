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

<div id="mensagem" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
    <br>
    <div class="form-group">
        <label for="nome"><span style="color: dodgerblue">*</span>Mensagem:</label><input class="form-control" name="mensagem" type="text">
        <input class="form-control" name="salas_id" type="hidden" value="<?php echo $id_sala;?>">
    </div>

    <div class="clearfix"></div>
</div>

<div class="text-right">
    <input type="submit" id="enviar" onclick="postMensagem();" class="btn btn-primary" value="Salvar">
</div>

<div>
    <a href="/Sala/sair/<?php echo $id_sala;?>"><button>Sair da sala</button></a>
    <h2>Usuários:</h2>
    <div id="usuarios" style="width:50%; float:left">
    </div>
    <h2>Enviar para:</h2>
    <div id="enviarpara" style="width:50%; float:right">
    </div>
</div>


<script>
    var mensagens = [];
    var lastTimeID = 1;
    var sala = <?php echo ($id_sala) ? $id_sala: '0'?>;


    $("*").keyup(function(e){
        if(e.keyCode == 13){
            postMensagem();
        }
    })

    var postMensagem = () => {
        console.log($('#mensagem').serialize());
        var campos = $('#mensagem').serialize();
        campos += '&para_id='+$("input[name=msg_secreta]:checked").val();
        console.log(campos);
        $.ajax({
            type: "POST",
            url: "/Mensagem/cadastrar_post",
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
            url: "/Mensagem/Listar/"+ sala +"/"+lastTimeID,
            contentType: 'application/json;charset=UTF-8',

            success:function (response){
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

                    if(mensagem['id'] !== lastTimeID){
                        lastTimeID = mensagem['id'];
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
        var query = '/Sala/banirUsuario/<?php echo $id_sala;?>/'+id;
        $.get(query, {},
            function(data){
            })
    };
    load();
    setInterval(load,2000);


</script>