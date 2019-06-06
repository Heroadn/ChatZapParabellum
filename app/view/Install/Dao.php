<style>
    body {
        margin: 0;
        font-family: 'Open Sans',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.45;
        background-color: #F5F7FA;
    }

    .card .card-title {
        font-weight: 500;
        letter-spacing: .05rem;
        font-size: 1.12rem;
    }
</style>

<div class="row match-height match-width">
        <?php
            foreach ($tables as $key => $table) {
                //echo '<div class="col-md-2">';
                createCard(ucfirst($key),'<p>'.implode('</p>',$table));
                //echo '</div>';
            }
        ?>
</div>

<?php function createCard($head,$content){?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $head;?></h5>

                <div class="card-content">
                    <ul class="list-group">
                        <?php echo $content;?>
                    </ul>
                </div>

            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary btn-sm btn-block" onclick="location.href = '';">Criar </button>
            </div>
        </div>
<?php }?>


<script>
    bootcards.init({
        offCanvasBackdrop: true,
        offCanvasHideOnMainClick: true,
        enableTabletPortraitMode: true,
        disableRubberBanding: true
    });
</script>

