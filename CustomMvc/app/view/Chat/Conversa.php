<?php
    if(!isset($_SESSION['usuario_id'])) {
        header("Location:/Usuario/Login");
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
    <input type="submit" onclick="formAX();" class="btn btn-primary" value="Salvar">
</div>

<script>
    var array = [];
    var load = function loadDoc() {
        $.ajax({
            type: "GET",
            url: "/Chat/Mensagem",
            contentType: 'application/json;charset=UTF-8',
            success:function (response){
                data = JSON.parse(response);
                //Adiciona as mensagens dentro do array
                for(m in data){
                    var exists = false;
                    var mensagem = {};
                    mensagem['id'] = data[m]['id'];
                    mensagem['mensagem'] = data[m]['mensagem'];
                    mensagem['data'] = data[m]['data'];
                    mensagem['usuario'] = data[m]['usuarios_id'];
                    mensagem['sala'] = data[m]['salas_id'];

                    if(array.length !== 0){
                        //Verificando se a mensagem já existe
                        for(d in array) {
                            if(array[d]['id'] === mensagem['id']){
                                exists = true
                                break
                            }
                        }
                    }else{
                        array.push(mensagem)
                        exists = true
                    }

                    //Adiciona a mensagem caso nao exista
                    if(exists === false){
                        array.push(mensagem)
                    }
                }

                var text = ""
                for(d in array) {
                    text += "<br>" + array[d]['mensagem'];
                }

                document.getElementById("chat").innerHTML = text;
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
    setInterval(load,4000);
    
    function formAX() {
        $.ajax({
            type: "POST",
            url: "/Chat/cadastrar_post",
            data: $("#mensagem").serialize(),
            success:function (response){
                alert(response);
            },
            error:function (jqXHR, textStatus, errorThrown){
                // Log the error to the console
                alert(
                    "The following error occurred: "+
                    textStatus, errorThrown
                );
            }
        });
    }
</script>
