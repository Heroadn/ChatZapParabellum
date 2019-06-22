<?php
    /** @var Usuarios $Usuario */
?>


<div class="row">
    <?php
        if($Usuario != false){
            usuarioEncontrado($Usuario);
        }else{
            echo 'não encontrado';
        }
    ?>
</div>

<?php function usuarioEncontrado($Usuario){?>
    <div class="col-sm-12 col-md-12">
        <br>
        <h4>Nome:</h4>

        <p><?php echo $Usuario->nome ?></p>
        <br>

        <h4>Email:</h4>

        <p><?php echo $Usuario->email ?></p>
        <br>
        <br>
        <hr>
        <br>
        <p><?php echo '<img src="'.$Usuario->foto_perfil.'">' ?></p>
        <br>
        <br>
        <hr>
        <br>
        <a href="../Alterar/<?php echo $Usuario->id ?>" > Alterar Informações </a>
        <hr>
    </div>

  
<?php return;}?>
