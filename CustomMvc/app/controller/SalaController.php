<?php
class SalaController extends Controller
{
    /**
     * @param string $id
     * @param string $name
     */
    public function Cadastrar(){
        $Categorias = Categorias::findAll();
        //view(nomeView,paramentros /id/name);
        $this->view(['Categorias' =>$Categorias]);
        //Titulo da Pagina
        $this->view->page_title = 'Cadastrar Sala';
        //Carrega a View
        $this->view->render();
    }

    /**
     * Ele retorna um json com o usuario requisitado ou todos
     * @param string $id
     */
    public function Listar($id=''){
        $Salas = ($id != '') ? Salas::findAll(['moderador_id'=>$id]) : Salas::findAll();
        echo json_encode($Salas);
    }

    /**
     * @param string $id_sala
     */
    public function Conversar($id_sala=''){
        $this->view(['id_sala'=>$id_sala]);
        $this->view->page_title = 'Conversar';
        $this->view->render();
    }

    /**
     *Metodo Cadastra a Sala no banco de dados via Json "POST"
     */
    public function cadastrar_post(){
        $json = json_decode(file_get_contents('php://input'), true);
        $Salas = new Salas();

        if($json){
            $Salas->nome          = filter_var($json['nome'], FILTER_SANITIZE_STRING);
            $Salas->senha         = md5(filter_var($json['senha'], FILTER_SANITIZE_STRING). SALT);
            $Salas->moderador_id  = $_SESSION['usuario_id'];
            $Salas->categorias_id = filter_var($json['categorias_id'], FILTER_SANITIZE_STRING);
        }else{
            $Salas->nome  = filter_input(INPUT_POST, 'nome');
            $Salas->senha = md5(filter_input(INPUT_POST, 'senha'). SALT);
            $Salas->moderador_id = $_SESSION['usuario_id'];
            $Salas->categorias_id = filter_input(INPUT_POST, 'categorias_id');
        }

        $Salas->save($Salas);
    }
}
