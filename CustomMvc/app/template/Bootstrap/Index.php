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

    <body>
        <style>
            body{
                background-image: url("<?php echo str_replace('\\','/',IMG . 'car.jpg')?>");
                background-repeat:no-repeat;
                background-size: cover;
            }
        </style>

        <!-- Navegação -->
      <nav class="navbar navbar-expand-sm navbar-dark purple">
				<div class="container">
					<a class="navbar-brand h1 mb-0 mr-5" href="/">
            <img alt="Logo do ZapChat" src="app/libs/img/logowhite_zapchat.png" width="40px">
						&nbsp;&nbsp; ZapChat
					</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
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

        <!-- Container -->
        <div class="container"  style="margin-top: 3%;margin-bottom: 3%">
            <div class="card">
                <div class="card-header">
                    <?php echo $this->page_title;?>
                </div>
                <div class="card-body">
                    <?php $this->getContent();?>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center">
            <a href="#"><?php echo 'Page loaded in ' . number_format(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],3) . ' seconds!';?></a>
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
                    <!--
                    <div class="modal-body text-center">
                        <iframe width="100%" height="350" src="/Usuario/Cadastrar"></iframe>
                    </div>-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
