<?php

class CategoriaController extends Controller
{
    /**
     * @param string $id
     * @param string $name
     */
    public function Cadastrar($id='', $name=''){
        $this->view(['id' =>$id, 'name' =>$name]);
        $this->view->page_title = 'Cadastrar Categoria';
        $this->view->render();
    }

    /**
     * @param string $id
     */
    public function Listar($id=''){
        $token  = Token::getTokenFromHeadersOrSession('Token','Authorization');

        if(Assert::equalsOrError(Usuarios::findById($token->id)->admin,true)){
            $Categorias = ($id != '') ? Categorias::findById($id) : Categorias::findAll() ;
        }else{
            $Categorias = ['erro'=>'Autenticação é requerida'];
        }

        header("Content-type:application/json");
        echo json_encode($Categorias);
    }

    /**
     *  Metodo Cadastra a Sala no banco de dados via Formulario "POST"
     */
    public function cadastrar_post(){
        $json = json_decode(file_get_contents('php://input'), true);
        $Categorias = new Categorias();

        if($json){
            $Categorias->nome = filter_var($json['nome'], FILTER_SANITIZE_STRING);
        }else{
            $Categorias->nome = filter_input(INPUT_POST, 'nome');
        }

        $Categorias->save($Categorias);
        header('Location:' . '/Categoria/Cadastrar');
    }

    public function ListCategoriasWithSalas(){
        $Categorias = Categorias::getCategoriasWithSalas();
        echo json_encode($Categorias);
    }
	
	public function listar_por_relevancia(){
		SalaController::update_all_usuarios();
		$Categorias = Categorias::getRelevantes();
		echo json_encode($Categorias);
	}
	
}
