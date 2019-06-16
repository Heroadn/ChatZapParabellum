<h1 class="p-text"> Crie seu ZChat</h1> 
<h4 class="p-text">	Não esqueça de convidar com seu amigos! </h4>
<br>

<div class="row text-center">
    <form method="post" role="form" action="/Sala/cadastrar_post/"  enctype="multipart/form-data">
		<div class="col-6">
            <label for="nome">Nome da Sala:</label>
            <input class="form-control form-purple" type="text" name="nome" id="nome_sala" required placeholder="Nome da Sala">
			<br>
            <label for="senha">Senha da Sala:</label>
            <input class="form-control form-purple" type="password" name="senha" id="senha_sala" placeholder="Senha da Sala">
		</div>
		<div class="col-6 mt-3">
				<div class="row">
					<div class="col">
						<input type="file" name="foto_sala" class="foto_new btn btn-purple purple" id="img_sala">
					</div>
				</div>
			<div class="mt-2">
				<label for="nome">Editar Descrição:</label>
				<textarea class="form-control form-purple" id="desc_new" required placeholder="Descrição da sala" maxlength="190" rows="3" style="resize: none"></textarea>
			</div>
		</div>
		<div class="col-12 mt-3">
			<div>
				<label for="tag">Adicione Tags:</label>
				
				<div class="input-group mb-3">
				  <input type="text" class="form-control tag_new" name="tags" placeholder="Adicione Tags" aria-label="Adicione Tags" aria-describedby="tag_add">
				  <div class="input-group-append">
					<button class="btn btn-purple purple" type="button" onClick="add_new_tag()" id="tag_add">Adicionar</button>
				  </div>
				</div>
				
				<div class="new_tag_area" style="height: 100px; overflow: auto; border: 1px dashed var(--purple)">
				
				</div>
				<small id="nameHelp" class="form-text text-muted">Coloque no minimo 3 tags...</small>
			</div>
		</div>

        <br>
        <br>

        <div class="col mt-3">
                <label for="categoria">Selecionar Categoria:</label>
                <br>
                <select name="categorias_id" id="categoria_sala">
                    <?php
                    foreach ($Categorias as $Categoria){
                        echo '<option value='.$Categoria->id.'>'.$Categoria->nome.'</option>';
                    }
                    ?>
                </select>

                <br>

                <input class="btn btn-purple purple" type="submit" value="Salvar">
        </div>
    </form>
</div>
<script src="<?php echo JS . 'tags_criar.js'?>"></script>
<script src="<?php echo JS . 'integridade_criar.js'?>"></script>