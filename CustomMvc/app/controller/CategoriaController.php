<?php
class CategoriaController extends Controller
{
    private $daoCategorias;

    //Inicializa a interface entre modelo e o banco de dados
    public function __construct(){
        $this->daoCategorias = new DaoCategorias;
    }

    public function Cadastrar($id='',$name=''){
        //view(nomeView,paramentros /id/name);
        $this->view(['id' =>$id, 'name' =>$name]);
        //Titulo da Pagina
        $this->view->page_title = 'Cadastrar Categoria';
        //Carrega a View
        $this->view->render();
    }

    /*Metodo Cadastra a Sala no banco de dados via Formulario "POST"*/
    public function cadastrar_post(){
        $Categorias = new Categorias();
        $Categorias->nome  = filter_input(INPUT_POST, 'nome');

        $this->daoCategorias->save($Categorias);
        header('Location:' . '/Categoria/Cadastrar');
    }

    /*Metodo Cadastra a Sala no banco de dados via Json "POST"*/
    public function cadastrar_json(){
        //Recebe o arquivo do tipo json
        $json = json_decode(file_get_contents('php://input'), true);

        //Salva no banco de dados cada usuario recebido
        $Categorias = new Categorias();
        $Categorias->nome          = filter_var($json['nome'], FILTER_SANITIZE_STRING);
        $this->daoCategorias->save($Categorias);
    }
}
