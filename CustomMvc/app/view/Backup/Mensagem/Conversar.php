<?php
    if(!isset($_SESSION['usuario_id'])) {
        header("Location:/Usuario/Login");
    }

    /** @var TYPE_NAME $id_sala */
    if($id_sala === ''){
        echo '<h3>' .'Sala não selecionada:'. '</h3>';
        echo '<p>' .'Post de messangem ficara indisponivel.'. '</p>';
    }
?>

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

<script>
    var mensagens = [];
    var sala = <?php echo ($id_sala) ? $id_sala: '0'?>;
    var lastTimeID = 0;

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
        $.ajax({
            type: "GET",
            url: "/Mensagem/Listar",
            contentType: 'application/json;charset=UTF-8',
            success:function (response){
                json = JSON.parse(response);
                //Adiciona as mensagens dentro do array
                for(m in json){
                    var status = false;
                    var mensagem = {};
                    mensagem['id'] = json[m]['id'];
                    mensagem['mensagem'] = json[m]['mensagem'];
                    mensagem['data'] = json[m]['data'];
                    mensagem['usuario'] = json[m]['usuarios_id'];
                    mensagem['sala'] = json[m]['salas_id'];

                    //Se não estiver vazio
                    if(mensagens.length !== 0){
                        //Verificando se a mensagem já existe dentro do array do usuario
                        for(d in mensagens) {
                            if(mensagens[d]['id'] === mensagem['id']){
                                status = true;
                                break;
                            }
                        }
                    }else{
                        mensagens.push(mensagem);
                        status = true;
                    }

                    //Adiciona a mensagem caso nao exista
                    if(status === false){
                        mensagens.push(mensagem);
                    }
                }

                var text = "";
                for(d in mensagens) {
                    text += "<br>" + mensagens[d]['mensagem'];
                }

                document.getElementById("chat").innerHTML = text;
            },
            error:function (jqXHR, textStatus, errorThrown){
                // Log the error to the console
                /*
                alert(
                    "The following error occurred: "+
                    textStatus, errorThrown
                );*/
            }
        });
    };

    load();
    setInterval(load,4000);
</script>
