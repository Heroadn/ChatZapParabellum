<?php

class CategoriaController extends Controller
{
    /**
     * @param string $id
     * @param string $name
     */
    public function Cadastrar($id='', $name=''){
        $token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
        $isAdmin = isset($token->id) && Assert::equalsOrError(Usuarios::findById($token->id)->admin,true);
		
		if ($isAdmin){
			$this->view(['id' =>$id, 'name' =>$name]);
			$this->view->page_title = 'Cadastrar Categoria';
			$this->view->render();	
		}
		else{
			echo 'VOCÊ NÃO TEM PERMISSÃO DE ADMINISTRADOR!!!!!!';
		}
    }

	public function Listar($opcao='', $parametro=1, $limit=10){
        $token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
        $isAdmin = isset($token->id) && Assert::equalsOrError(Usuarios::findById($token->id)->admin,true);
        $opcao = strtolower($opcao);

        $start = intval($parametro);
        $page = ($start * $limit) - $limit;
        $size = 0;
		
        switch($opcao){
            case 'relevantes':
				SalaController::update_all_usuarios();
                $Categorias = Categorias::getRelevantes($page, $limit);
				$size = ceil(Categorias::count() / $limit);
                break;
            case 'todos':
                $Categorias = Categorias::findAll([],['limit'=>['start'=>$page,'limit'=>$limit]]);
				$size = ceil(Categorias::count() / $limit);
                break;
            default:
                $Categorias = Categorias::findAll([],['limit'=>['start'=>$page,'limit'=>$limit]]);
				$size = ceil(Categorias::count() / $limit);
        }

        header("Access-Control-Allow-Origin: *");
        header("Content-type:application/json");
		echo json_encode(array('Categorias'=>$Categorias,'pag'=>['page'=>($page / $limit) + 1,'size'=>$size]));
    }
    /**
     *  Metodo Cadastra a Sala no banco de dados via Formulario "POST"
     */
    public function cadastrar_post(){
        $token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
        $isAdmin = isset($token->id) && Assert::equalsOrError(Usuarios::findById($token->id)->admin,true);
		
		if ($isAdmin){
			$json = json_decode(file_get_contents('php://input'), true);
			$Categorias = new Categorias();

			if($json){
				$Categorias->nome = filter_var($json['nome'], FILTER_SANITIZE_STRING);
				$Categorias->descricao = filter_var($json['descricao'], FILTER_SANITIZE_STRING);
				$Categorias->foto_categoria = Upload::save('foto_categoria','categoria_'.$Categorias->nome.'_');
			}else{
				$Categorias->nome = filter_input(INPUT_POST, 'nome');
				$Categorias->descricao = filter_input(INPUT_POST, 'descricao');
				$Categorias->foto_categoria = Upload::save('foto_categoria','categoria_'.$Categorias->nome.'_');
				
			}

			$Categorias->save($Categorias);
			header('Location:' . '/Categoria/Cadastrar');	
		}
    }

    public function ListCategoriasWithSalas(){
        $Categorias = Categorias::getCategoriasWithSalas();
        echo json_encode($Categorias);
    }
}
