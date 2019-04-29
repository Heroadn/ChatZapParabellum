<?php
class SalaController extends Controller
{
    private $daoSalas;

    //Inicializa a interface entre modelo e o banco de dados
    public function __construct(){
        $this->daoSalas = new DaoSalas;
    }

    public function Cadastrar($id='',$name=''){
        //view(nomeView,paramentros /id/name);
        $this->view(['id' =>$id, 'name' =>$name]);
        //Titulo da Pagina
        $this->view->page_title = 'Cadastrar Sala';
        //Carrega a View
        $this->view->render();
    }

    /*Metodo Cadastra a Sala no banco de dados via Formulario "POST"*/
    public function cadastrar_post(){
        $Salas = new Salas();
        $Salas->nome  = filter_input(INPUT_POST, 'nome');
        $Salas->senha = filter_input(INPUT_POST, 'senha');
        $Salas->moderador_id = filter_input(INPUT_POST, 'moderador_id');
        $Salas->categorias_id = filter_input(INPUT_POST, 'categorias_id');
        $this->daoSalas->save($Salas);
        header('Location:' . '/Sala/Cadastrar');
    }

    /*Metodo Cadastra a Sala no banco de dados via Json "POST"*/
    public function cadastrar_json(){
        //Recebe o arquivo do tipo json
        $json = json_decode(file_get_contents('php://input'), true);
        //Salva no banco de dados cada usuario recebido
        $Salas = new Salas();
        $Salas->nome          = filter_var($json['nome'], FILTER_SANITIZE_STRING);
        $Salas->senha         = filter_var($json['senha'], FILTER_SANITIZE_STRING);
        $Salas->moderador_id  = filter_var($json['moderador_id'], FILTER_SANITIZE_STRING);
        $Salas->categorias_id = filter_var($json['categorias_id'], FILTER_SANITIZE_STRING);
        $Salas->senha         = md5($Usuario->senha . SALT);
        $this->daoSalas->save($Salas);
    }
}
