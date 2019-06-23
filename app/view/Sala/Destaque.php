<?php
    /** @var TYPE_NAME $Salas_Todas */
    /** @var TYPE_NAME $Salas_Destaque */
    echo '<h4>Todas</h4>';
    foreach($Salas_Todas as $value){
        echo '<a href ="' .'Conversar/'.$value->id. '">'.$value->nome.'</a>' . '<br>';
    }

    echo '<h4>Destaque</h4>';
    foreach($Salas_Destaque as $value){
        echo '<a href ="' .'Conversar/'.$value->id. '">'.$value->nome.'</a>' . '<br>';
    }
?>