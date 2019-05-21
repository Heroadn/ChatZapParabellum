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
<?php /** @var TYPE_NAME $Categorias */
    if(!isset($_SESSION['usuario_id'])) {
        header("Location:/Usuario/Login");
    }
?>
<div class="row">
    <div class="col s12 m6 l6">
        <form method="post" role="form" action="/Sala/cadastrar_post">
            <label for"nome">Nome da Sala:</label>
            <br>
            <input type="text" name="nome" id="nome" required placeholder="Nome da Sala">
            <br>
            <br>

            <label for"senha">Senha da Sala:</label>
            <br>
            <input type="password" name="senha" id="senha" placeholder="Senha da Sala">
            <br>
            <br>

            <label for="categoria">Selecione Categoria:</label>
            <select name="categorias_id" id="categorias">
                <?php
                foreach ($Categorias as $Categoria){
                        echo '<option>'.$Categoria->nome.'</option>';
                    }
                ?>
            </select>

            <input type="submit" id="criar" value="Criar">
            <input type="reset" value="Cancelar">
        </form>
    </div>

    <div class="col s12 m6 l6">
        <form>
            <label for="tag">Adicione Tags:</label>
            <input type="text" name="tag" id="tag" placeholder="Adicione Tags">
        </form>
    </div>
</div>