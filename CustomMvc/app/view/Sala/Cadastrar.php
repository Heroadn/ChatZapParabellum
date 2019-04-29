<form class="form-horizontal" method="post" role="form" action="/Sala/cadastrar_post"  enctype="multipart/form-data">
    <div class="text-info">Os campos marcados com <i class="fa fa-asterisk"></i> são de preenchimento obrigatório.</div>
    <br>
    <div class="form-group">
        <label for="nome"><span style="color: dodgerblue">*</span>Nome:</label>  <input class="form-control" name="nome" type="text">
        <label for="senha"><span style="color: dodgerblue">*</span>Senha:</label><input class="form-control" name="senha" type="password">
        <label for="moderador"><span style="color: dodgerblue">*</span>Moderador:</label><input class="form-control" name="moderador_id" type="text">
        <label for="admin"><span style="color: dodgerblue">*</span>Categorias:</label><input class="form-control" name="categorias_id" type="text">
    </div>

    <div class="clearfix"></div>
    <div class="text-right">
        <a href="" class="btn btn-default" data-dismiss="modal">Cancelar</a>
        <input type="submit" class="btn btn-primary" value="Salvar">
    </div>
</form>