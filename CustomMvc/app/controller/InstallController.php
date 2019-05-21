<?php


class InstallController extends Controller
{
    /**
     *
     */
    public function Controller(){
        $files = array_diff(scandir(CONTROLLER), array('.', '..'));
        $this->view(["Files"=>$files],'Controller');
        $this->view->page_title = 'Install controller';
        $this->view->render();
    }

    /**
     *
     */
    public function Template(){
        $this->view([]);
        $this->view->page_title = 'Install template';
        $this->view->render();
    }

    /**
     *
     */
    public function Nav(){
        $this->view([]);
        $this->view->page_title = 'Install template';
        $this->view->render();
    }

    /**
     *
     */
    public function Dao(){
        $this->view([],'Dao');
        $this->view->page_title = 'Install dao';
        $this->view->render();
    }

    /**
     *
     */
    public function controller_post(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome');
            $controller = fopen(CONTROLLER . $nome . 'Controller.php', "w");
            $txt = include(VIEW . 'Install' . DIRECTORY_SEPARATOR . 'Controller_Model.php');
            fwrite($controller, $txt);

            $path = VIEW . $nome;
            if (!file_exists($path)) {
                mkdir(VIEW . $nome, 0777, true);
                fopen(VIEW . $nome .  DIRECTORY_SEPARATOR . 'Index.php', "w");
            }
        }
        header('Location:' . '/Install/Controller');
    }

    /**
     *
     */
    public function template_post(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome');
            $css = filter_input_array(INPUT_POST)['css'];
            $js = filter_input_array(INPUT_POST)['js'];

            //Criar pasta do template
            $path = TEMPLATE . $nome;
            if (!file_exists($path)) {
                mkdir(TEMPLATE . $nome, 0777, true);
            }

            //Criando Configuração do Template
            $file = fopen($path . DIRECTORY_SEPARATOR . 'Config.php', "w");
            $txt = "<?php \n##Inicialização de CSS e JS\ndefine('CSS_HEADER',serialize([\n" . "'" . implode("','", $css) . "'\n" . "]));\ndefine('JS_HEADER',serialize([\n" . "'" . implode("','", $js) . "'\n" . "]));\n";
            fwrite($file, $txt);

            //Criando index e nav padrao
            $file = fopen($path . DIRECTORY_SEPARATOR . 'Index.php', "w");
            $txt = "<!DOCTYPE html>\n<\html>\n<\head>\n    <\meta charset=\"UTF-8\">\n    <\title><?php echo \$this->page_title;?><\/title>\n<?php\n//Carrega os arquivos Css\n    \$this->loadCss();\n    //Carrega os arquivos Js\n    \$this->loadJs();\n    ?>\n\<\head>\n<\body>\n    //Inclui o arquivo Nav.php    <?php \$this->getNav();?>\n    //Inclui a view no template    <?php \$this->getContent();?>\n<\/body>\n";
            fwrite($file, $txt);
            $file = fopen($path . DIRECTORY_SEPARATOR . 'Nav.php', "w");
        }

        header('Location:' . '/Install/Template');
    }
}