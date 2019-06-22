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

    <div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php return;}?>
