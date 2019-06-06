<form class="form-horizontal" method="post" role="form" action="/Categoria/cadastrar_post"  enctype="multipart/form-data">
    <div class="text-info">Os campos marcados com <i class="fa fa-asterisk"></i> são de preenchimento obrigatório.</div>
    <br>
    <div class="form-group">
        <label for="nome"><span style="color: dodgerblue">*</span>Nome:</label>  <input class="form-control" name="nome" type="text">
		<label for="descricao"><span style="color: dodgerblue">*</span>Descrição:</label><textarea class="form-control" name="descricao"></textarea>
		<label for="foto_categoria"><span style="color: dodgerblue">*</span>Foto:</label><input class="form-control" name="foto_categoria" type="file">
    </div>

    <div class="clearfix"></div>
    <div class="text-right">
        <a href="" class="btn btn-default" data-dismiss="modal">Cancelar</a>
        <input type="submit" class="btn btn-primary" value="Salvar">
    </div>
</form>