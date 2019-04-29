<?php
class ChatController extends Controller
{
    private $daoMensagens;

    //Inicializa a interface entre modelo e o banco de dados
    public function __construct(){
        $this->daoMensagens = new DaoMensagens;
    }

    public function Cadastrar($id='',$name=''){
        //view(nomeView,paramentros /id/name);
        $this->view(['id' =>$id, 'name' =>$name]);
        //Titulo da Pagina
        $this->view->page_title = 'Cadastrar Mensagem';
        //Carrega a View
        $this->view->render();
    }

    public function Mensagem($id_sala=''){
        $Mensagens = $this->daoMensagens->findAll();
        $this->view(['id_sala' =>$id_sala,'Mensagens'=>$Mensagens]);
        $this->view->ajax();
    }

    public function Conversa($id_sala=''){
        $this->view(['id_sala'=>$id_sala]);
        $this->view->page_title = 'Conversa';
        $this->view->render();
    }

    /*Metodo Cadastra a Sala no banco de dados via Formulario "POST"*/
    public function cadastrar_post(){
        //Verifica se o usuario esta logado
        if(!isset($_SESSION['usuario_id'])) {header("Location:/Usuario/Login");}

        //Cadastrar a mensagem
        $Mensagens = new Mensagens;
        $Mensagens->mensagem   = filter_input(INPUT_POST, 'mensagem');
        $Mensagens->salas_id   = filter_input(INPUT_POST, 'salas_id');
        $Mensagens->usuarios_id = $_SESSION['usuario_id'];
        $Mensagens->data       = date("Y-m-d H:i:s");
        $this->daoMensagens->save($Mensagens);
        //header('Location:' . '/Chat/Conversa');
    }

    /*Metodo Cadastra a Sala no banco de dados via Json "POST"*/
    public function cadastrar_json(){
        //Recebe o arquivo do tipo json
        $json = json_decode(file_get_contents('php://input'), true);

        //Salva no banco de dados cada usuario recebido
        $Mensagens = new Mensagens();
        $Mensagens->mensagem   = filter_var($json['mensagem'], FILTER_SANITIZE_STRING);
        $Mensagens->usuarios_id = filter_var($json['usuario_id'], FILTER_SANITIZE_STRING);
        $Mensagens->salas_id   = filter_var($json['salas_id'], FILTER_SANITIZE_STRING);
        $Mensagens->data       = date("Y-m-d H:i:s");
        $this->daoMensagens->save($Mensagens);
    }
}
