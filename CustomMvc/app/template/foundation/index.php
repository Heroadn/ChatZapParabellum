<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo (isset($this->page_title) ? $this->page_title : 'NONE');?></title>
        <?php
        foreach(CSS_HEADER as $value){
            echo '<link href="'.CSS . $value .'" rel="stylesheet">';
        }
        ?>
    </head>
    <body>
        <?php $this->getNav();?>
        <?php $this->getContent();?>

            <!-- Modal
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div style="text-align:center"><img src="<?php //echo SITE_PATH; ?>/template/default/images/loading.gif" alt="LazyPHP"></div>
                </div>
            </div>
        </div>-->

        <footer class="text-center">
            <a href="#"><?php echo 'Page loaded in ' . number_format(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],3) . ' seconds!';?></a>
        </footer>
    </body>

    <?php
        foreach(JS_HEADER as $value){
            echo '<script src="'.JS . $value.'"></script>';
        }
    ?>
</html>



