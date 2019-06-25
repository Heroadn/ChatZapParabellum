<?php
    if(!isset($_SESSION['Token'])) {
        header("Location:/Usuario/Login");
    }

    /** @var TYPE_NAME $id_sala */
    if($id_sala === ''){
        echo '<h3>' .'Sala não selecionada:'. '</h3>';
        echo '<p>' .'Post de messangem ficara indisponivel.'. '</p>';
    }
?>
<div class="darken">
	<div class="menssages h-80" id="boxChat">

	</div>
	<hr>
	<form class="h-20" id="formChat">
		<div class="form-group p-3 text-center">
			<div class="row">
				<div class="col-9">
					<input type="text" class="form-darken-purple" id="mensgtextarea" placeholder="Digite">
				</div>
				<div class="col-3">
					<button class="btn btn-purple purple">Enviar</button>
				</div>
			</div>
		</div>
	</form>
</div>

<script src="<?php echo JS . 'chat.js'?>"></script>
<script src="<?php echo JS . 'pessoas_online.js'?>"></script>
