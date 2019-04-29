<?php
    echo '<style>tr:nth-child(even) {background-color: #f2f2f2;}</style>';
    echo '<table id="tabela" style="width:100%;">';
        //Carregada via ajax
    echo '</table>';
?>
<button type="button" data-toggle="modal" data-target="#modal">Cadastrar</button>
<button type="button" onclick="loadDoc()">Recaregar</button>

<script>
    var load = function loadDoc() {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tabela").innerHTML = this.responseText;
            }
        };
        x.open("GET", "/Ajax/Mensagem", true);
        x.send();
    };

    setInterval(load,4000);
</script>
