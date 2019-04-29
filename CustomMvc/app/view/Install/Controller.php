<h1>Criar Controller</h1>
<form class="form-horizontal" method="post" role="form" action="/Install/controller_post"  enctype="multipart/form-data">
    <div class="text-info">Os campos marcados com <i class="fa fa-asterisk"></i> são de preenchimento obrigatório.</div>
    <br>
    <div class="form-group">
        <label for="nome"><span style="color: dodgerblue">*</span>Nome:</label> <input class="form-control" name="nome" type="text">
    </div>

    <div class="clearfix"></div>
    <div class="text-right">
        <input type="submit" class="btn btn-primary" value="Criar">
    </div>
</form>

<?php
    foreach ($Files as $file){
        //$controller = fopen(CONTROLLER . $file, "r") or die("Unable to open file!");
        //echo fread($controller,filesize((CONTROLLER . $file)));
        //fclose($controller);
        //$text = file_get_contents($file);
    }
?>
