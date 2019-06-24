<?php
    $this->loadJs();
    $this->loadCss();
?>

<div class="darken">
    <div class="menssages" id="boxChat" style="height: 400px;">

    </div>

    <hr>
    <form id="formChat">
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