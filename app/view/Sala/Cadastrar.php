<!--<form class="form-horizontal" method="post" role="form" action="/Sala/cadastrar_post"  enctype="multipart/form-data">
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
</form>-->
<div class="row">
    <div class="col s12 m6 l6">
        <form method="post" role="form" action="/Sala/cadastrar_post" enctype="multipart/form-data">
            <label for"nome">Nome da Sala:</label>
            <br>
            <input type="text" name="nome" id="nome" required placeholder="Nome da Sala">
            <br>
            <br>

            <label for"senha">Senha da Sala:</label>
            <br>
            <input type="password" name="senha" id="senha" placeholder="Senha da Sala">
            <br>
			<label for="descricao"><span style="color: dodgerblue">*</span>Descrição:</label><textarea class="form-control" name="descricao"></textarea>
			<br>
            <label for="tags">Tags:</label>
            <input type="text" name="tags" id="tags" placeholder="Adicione aqui as tags">
			<br>
			<label for="foto_sala"><span style="color: dodgerblue">*</span>Foto:</label><input class="form-control" name="foto_sala" type="file">
			<br>
            <label for="categoria">Selecione Categoria:</label>
            <select name="categorias_id" id="categorias">
                <?php
                foreach ($Categorias as $Categoria){
                        echo '<option value='.$Categoria->id.'>'.$Categoria->nome.'</option>';
                    }
                ?>
            </select>
            <input type="submit" id="criar" value="Criar">
            <input type="reset" value="Cancelar">
        </form>
    </div>
</div>