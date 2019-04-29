<form class="form-horizontal" method="post" role="form" action="/Usuario/cadastrar_post"  enctype="multipart/form-data">
    <div class="text-info">Os campos marcados com <i class="fa fa-asterisk"></i> são de preenchimento obrigatório.</div>
    <br>
    <div class="form-group">
        <label for="nome"><span style="color: dodgerblue">*</span>Nome:</label>  <input class="form-control" name="nome" type="text">
        <label for="senha"><span style="color: dodgerblue">*</span>Senha:</label><input class="form-control" name="senha" type="password">
        <label for="email"><span style="color: dodgerblue">*</span>Email:</label><input class="form-control" name="email" type="email">
        <label for="foto_perfil">Foto:</label><input class="form-control" name="foto_perfil" type="text">
        <label for="admin">Admin:</label><input class="form-control" name="admin" type="text">
    </div>

    <div class="clearfix"></div>
    <div class="text-right">
        <a href="" class="btn btn-default" data-dismiss="modal">Cancelar</a>
        <input type="submit" class="btn btn-primary" value="Salvar">
    </div>
</form>