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




<div id="editarperfil" class="modal fade" role="dialog" >
<div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
	    <div class="modal-header">
	    	<h1 class="p-text"> Editar seu Perfil </h1>

	    	<button type="button" class="close" data-dismiss="modal">
	    		<span>&times;</span>
	    	</button>

	    </div>
    <div class="modal-body">
      <!-- //class="form-horizontal -->
			<form id="form_editar_perfil" method="post" role="form" action="/Usuario/alterar_post"  enctype="multipart/form-data">
	      <div class="row">
					<div class="col-sm-9 col-md-4 col-lg-4 col-xl-4 text-center">
						<img class="border-purple img-fluid" id="img_user_show" src="<?php echo $Usuario->foto_perfil ?>" style="border-radius:50%;">
							<div class="form-group">
								<div class="row">
									<div class="col">
										<small id="fotohelp" class="form-text text-muted mb-3">Coloque de preferencia uma foto 3x4 :), use e abuse de gifs >w<</small>

										<input type="file" onchange="changeImg('img_perfil_new','img_user_show')" name="file" class="img-fluid img-thumbnail" id="img_perfil_new" style="display: none;"/>

										<button type="button" class="btn btn-purple purple btn-block" onclick="wayFile('img_perfil_new')">
											Mudar a Foto
										</button>
									</div>
								</div>
							</div>
					</div>
					<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
						<h5 class="p-text"> Nome de Usuario: <i style="font-size:30px"> <?php echo $Usuario->nome ?>.</i></h5>
							<div class="row">
								<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
									<input type="text" class="form-control" id="trocar_nome" placeholder="Coloque seu novo nome aqui...">
								</div>
							</div>
							<br>
							<h5 class="p-text"> Email de Usuario: <i style="font-size:30px"> <?php echo $Usuario->email ?> .</i></h5>
								<div class="row">
									<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
										<input type="text" class="form-control" id="trocar_nome" placeholder="Coloque seu novo email aqui...">
									</div>
								</div>
								<br>
								<br>
								<h5 class="p-text"> Você quer trocar sua senha?</h5>
								<p class="p-text"> Coloque sua senha ATUAL aqui: </p>
								<div class="row">
									<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
										<input type="text" class="form-control" id="senha_old" placeholder="Senha atual...">
									</div>
								</div>
								<p class="p-text"> Coloque sua senha NOVA aqui: </p>
								<div class="row">
									<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
										<input type="text" class="form-control" id="senha_new" placeholder="Nova senha...">
									</div>
							</div>
							<br>
							<button type="submit" class="btn btn-purple purple float-right">Salvar Alterações</button>
					</div>
				</div>
			</form>
			<div class="row">
				<div class="col-12 col-md-4 mb-4 msg_view">
					<div class="msnSystem">
						<div>
							<div class='msn'></div>
							<div class='exitMsn'>x</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
    </div>
      	<div class="modal-footer">
					<button type="button" class="btn btn-default p-text" data-dismiss="modal">Cancelar</button>
      	</div>
    </div>
	</div>
</div>
<?php return;}?>
