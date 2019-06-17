<?php
    /** @var Usuarios $Usuario */
?>

<div class="row">
    <?php
        if($Usuario != false){
            usuarioEncontrado($Usuario);
        }else{
            echo 'User not found!';
        }
    ?>
</div>

<?php function usuarioEncontrado($Usuario){?>
    <div class="col-sm-12 col-md-12">
        <br>
        <form class="form-horizontal" method="post" role="form" action="/Usuario/alterar_post"  enctype="multipart/form-data">
            <br>
            <div class="form-group">

                <br>
                <hr>
                <br>
                <h4>Nome:</h4>
                <label for="nome"><span style="color: dodgerblue">*</span>Nome:</label>  <input class="form-control" name="nome" type="text" value="<?php echo $Usuario->nome ?>">

                <br>
                <hr>
                <br>
                <h4>Senha:</h4>
                <label for="senha"><span style="color: dodgerblue">*</span>Senha:</label><input class="form-control" name="senha" type="password" >

                <br>
                <hr>
                <br>
                <h4>Email:</h4>
                <label for="email"><span style="color: dodgerblue">*</span>Email:</label><input class="form-control" name="email" type="email" value="<?php echo $Usuario->email ?>">

                <br>
                <hr>
                <br>
                <h4>Foto de Perfil:</h4>
                <label for="foto_perfil"><span style="color: dodgerblue">*</span>Foto:</label><input class="form-control" name="foto_perfil" type="file" value="<?php echo $Usuario->foto_perfil ?>">
            </div>
            <br>
            <div class="clearfix"></div>
            <div class="text-right">
                <a href="" class="btn btn-default" data-dismiss="modal">Cancelar</a>
                <input type="submit" class="btn btn-primary" value="Salvar">
            </div>
        </form>
        <a href="../Perfil/<?php $Usuario->id ?>">Voltar</a>
        <hr>

    </div>
<?php return;}?>
