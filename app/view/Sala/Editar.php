<div id="editar_sala" class="modal fade" role="dialog" style="right: auto;left: 0px;">
	<div class="modal-dialog" style="width:1250px;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header text-center">
			</div>
		    <div class="modal-body p-5">
				<div class="modal-body">
					<form id="form_editar_sala" action="/Sala/editar_post/<?php echo $Sala[0]->id ?>" method="post">
						<div class="row">
							<div class="col-6">
								<label for="nome">Editar Nome da Sala</label>
								<input class="form-control form-purple" type="text" name="nome" value="<?php echo $Sala[0]->nome ?>" id="nome_sala" required placeholder="Ex.: Batatinhas em Chamas">
							</div>

							<div class="col-6">
								<label for="senha">Editar Senha da Sala</label>
								<input class="form-control form-purple" type="password" name="senha" id="senha_sala" placeholder="Ex.: #bH3jD60!">
							</div>

							<div class="col-sm-12 col-md-6 mt-4">
								<label for="foto_sala">Adicione uma nova imagem ao Chat</label>
								<br>
								<img class="border-purple img-fluid" id="img_editar_sala" src="<?php echo'img/salas/error.jpg' ?>" style="border-radius:50%; max-width: 200px;">
								<br>
								<input type="file" onchange="changeImg('editar_sala_new','img_editar_sala')" name="foto_sala" class="img-fluid img-thumbnail" id="editar_sala_new" style="display: none;">
								<br>
								<button type="button" class="btn btn-purple purple btn-block" onclick="wayFile('editar_sala_new')">
									Adicionar Foto
								</button>
								<script src="/app/lib/js/img_insert_sala.js"></script>
							</div>

							<div class="col-sm-6 col-md-6 mt-4">
								<label for="desc">Editar Descrição</label>
								<textarea class="form-control form-purple" name="descricao" id="desc_new" required placeholder="Descrição da sala" maxlength="190" rows="3" style="resize: none"><?php echo $Sala[0]->descricao ?></textarea>
							</div>

							<div class="col-12 mt-3">
								<label for="tag">Editar Tags</label>
								<div class="input-group mb-3">
									<input type="text" name="tags" value="<?php echo $Sala[0]->tags ?>" class="form-control tag_new" placeholder="Adicione Tags" aria-label="Adicione Tags" aria-describedby="tag_add">

									<div class="input-group-append">
										<button class="btn btn-purple purple" type="button" onClick="add_new_tag()" id="tag_add">Adicionar</button>
									</div>

								</div>
								<div class="new_tag_area" style="height: 100px; overflow: auto; border: 1px dashed var(--purple)">
								</div>
							</div>

							<div class="col-12 mt-3">
								<label for="categoria">Selecionar Nova Categoria:</label>
								<br>
								<select name="categorias_id" id="categoria_sala">
									<?php
									  
									  foreach ($Categorias as $c){
											echo "<option value=$c->id>$c->nome</option>";
									  }
									?>
								</select>
							</div>
							<br>
							<button  class="btn btn-purple purple"  type="submit">Salvar Alterações</button>
						</div>
					</form>
				</div>
			</div>

		    <div class="modal-footer">
				<button  class="btn btn-purple purple" data-dismiss="modal" type="reset">Cancelar</button>
		    </div>
		</div>
	</div>
</div>
<script>
	$('#editar_sala').modal('show');
</script>
<script src="<?php echo JS . 'tags_editar.js'?>"></script>
<script src="<?php echo JS . 'integridade_editar.js'?>"></script>

