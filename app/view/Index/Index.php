<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $this->page_title;?></title>
        <?php
            //Carrega o css e o JS
            $this->loadCss();
            $this->loadJs();

            //Opcional
            $controller = $this->getController();
            $action = $this->getAction();
        ?>
    </head>

    <body class="darken">

        <nav class="navbar navbar-expand-md navbar-dark purple">
            <div class="container">
                <a class="navbar-brand h1 mb-0 mr-5" href="" style="color: var(--font-light)">
                    <img alt="asdasd" src="<?php echo IMG . 'logowhite_zapchat.png'?>" width="40px">
                    &nbsp;&nbsp; ZapChat
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite" style="color: white">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="container"></div>
                <div class="collapse navbar-collapse" id="navbarSite">
                    <ul class="navbar-nav">
                        <?php $this->getNav();?>
                    </ul>
                </div>
            </div>
        </nav>


        <!-- preload -->
        <div id="preLoad">
            <span id="primeiro"></span>
            <span></span>
            <span></span>
            <span></span>
            <span id="ultimoSpan"></span>
        </div>

        <!-- Container -->
        <div class="container"  style="margin-top: 3%;margin-bottom: 3%">
            <div class="row">
                <div class="col-12 col-md-6 mb-4 msg_view">
                    <div class="msnError">
                        <div class='msn'></div>
                        <div class='exitMsn'>x</div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="col-12 col-md-6 light rounded border border-white">
                    <form>
                        <div class="form-group">
                            <div id="text" class="pt-1">Pesquisar Sala por Nome:</div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <select id="inputState" onChange="switchSearch()" class="form-control">
                                        <option value="Nome" selected>NOME</option>
                                        <option value="Categoria">CATEGORIA</option>
                                        <option value="Tag">TAG</option>
                                        <option value="Relevancia">RELEVANCIA</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 inputSearch" id="inputSearch">
                                    <input type="text" class="form-control" id="pesq" placeholder="pesquisar...">
                                </div>
                                <div class="col-sm-4" id="select_search">
                                    <select class="form-control">
                                        <option value="Nome" selected>NOME</option>
                                        <option value="Categoria">CATEGORIA</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-purple purple" id="btnSearch">Pesquisar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="boxPages">
                <div class="mt-4 rounded border border-white text-center light boxCenter">
                    <?php $this->getContent();?>
                    <script src="<?php JS . 'err.js'?>"></script>
                    <script src="<?php JS . 'search_Sala.js'?>"></script>
                    <script src="<?php JS . 'pesq.js'?>"></script>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center">
            <a href="#"><?php //$time ='Page loaded in ' . number_format(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],3) . ' seconds!';if(DEBUG){echo $time;}?></a>
        </footer>

        <!-- Modal -->
        <div class="modal" id="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
