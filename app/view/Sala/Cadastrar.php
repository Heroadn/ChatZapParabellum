<h1 class="p-text">Crie seu ZChat</h1>
<h4 class="p-text">Não esqueça de convidar seus amigos!</h4>
<br>
<form id="form_criar_sala" action="/Sala/cadastrar_post" method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="col-6">
			<label for="nome">Nome da Sala</label>
			<input class="form-control form-purple" type="text" name="nome" id="nome_sala" required placeholder="Ex.: Batatinhas em Chamas">
		</div>

		<div class="col-6">
			<label for="senha">Senha da Sala</label>
			<input class="form-control form-purple" type="password" name="senha" id="senha_sala" placeholder="Ex.: #bH3jD60!">
		</div>

		<div class="col-sm-12 col-md-6 mt-4">
			<label for="foto_sala">Adicione uma imagem ao Chat</label>
			<br>
			<img class="border-purple img-fluid" id="img_criar_sala" src="../libs/img/salas/error.jpg" style="border-radius:50%; max-width: 200px;">
			<br>
			<input type="file" onchange="changeImg()" name="foto_sala" class="img-fluid img-thumbnail" id="foto_new" style="display: none;">
			<br>
			<button type="button" class="btn btn-purple purple btn-block" onclick="wayFile()">
			Adicionar Foto
			</button>
			<script src="<?php echo JS . 'img_insert_sala.js'?>"></script>
		</div>

		<div class="col-sm-6 col-md-6 mt-4">
			<label for="desc">Adicionar Descrição</label>
			<textarea name="descricao" class="form-control form-purple" id="desc_new" required placeholder="Descrição da sala" maxlength="190" rows="3" style="resize: none"></textarea>
		</div>

		<div class="col-12 mt-3">
			<label for="tag">Adicionar Tags</label>
			<div class="input-group mb-3">
				<input type="text" name="tags" class="form-control tag_new" placeholder="Adicione Tags" aria-label="Adicione Tags" aria-describedby="tag_add">
				<div class="input-group-append">
					<button class="btn btn-purple purple" type="button" onClick="add_new_tag()" id="tag_add">Adicionar</button>
				</div>
			</div>
			<div class="new_tag_area" style="height: 100px; overflow: auto; border: 1px dashed var(--purple)">
			</div>
		</div>

		<div class="col-12 mt-3">
			<label for="categoria">Selecionar Categoria:</label>
			<br>
			<select name="categorias_id" id="categoria_sala">
				<?php
				foreach ($Categorias as $Categoria){
					echo '<option value='.$Categoria->id.'>'.$Categoria->nome.'</option>';
				}
				?>
			</select>
		</div>
	</div>
	<br>
	<button  class="btn btn-purple purple"  type="submit">Criar Sala</button>
	<button  class="btn btn-purple purple" data-dismiss="modal" type="reset">Cancelar</button>
</form>
<script src="<?php echo JS . 'tags_criar.js'?>"></script>
<script src="<?php echo JS . 'integridade_criar.js'?>"></script>

