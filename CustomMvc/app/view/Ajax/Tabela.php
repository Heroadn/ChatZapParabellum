<?php

foreach ($Usuarios[0] as $key => $value) {
    echo '<th>' . $key . '</th>';
}

foreach ($Usuarios as $key => $value)
{
    echo '<tr>';
    foreach ($Usuarios[$key] as $usuario)
    {
        echo '<td>'.$usuario .'</td>';
    }
    echo '</tr>';
}