<form class="form-horizontal" method="post" role="form" action="/Chat/cadastrar_post"  enctype="multipart/form-data">
    <div class="text-info">Os campos marcados com <i class="fa fa-asterisk"></i> são de preenchimento obrigatório.</div>
    <br>
    <div class="form-group">
        <label for="nome"><span style="color: dodgerblue">*</span>Mensagem:</label>  <input class="form-control" name="mensagem" type="text">
        <label for="nome"><span style="color: dodgerblue">*</span>Usuario:</label>   <input class="form-control" name="usuarios_id" type="text">
        <label for="nome"><span style="color: dodgerblue">*</span>Sala:</label>      <input class="form-control" name="salas_id" type="text">
    </div>

    <div class="clearfix"></div>
    <div class="text-right">
        <a href="" class="btn btn-default" data-dismiss="modal">Cancelar</a>
        <input type="submit" class="btn btn-primary" value="Salvar">
    </div>
</form>