<!DOCTYPE html>
<\html>
<\head>
    <\meta charset="UTF-8">
    <	itle><?php echo $this->page_title;?><\/title>
<?php
//Carrega os arquivos Css
    $this->loadCss();
    //Carrega os arquivos Js
    $this->loadJs();
    ?>
\<\head>
<\body>
    //Inclui o arquivo Nav.php    <?php $this->getNav();?>
    //Inclui a view no template    <?php $this->getContent();?>
<\/body>
