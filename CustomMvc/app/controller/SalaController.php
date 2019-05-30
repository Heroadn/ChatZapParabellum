<?php
class SalaController extends Controller
{
    /**
     * @param string $id
     * @param string $name
     */
    public function Cadastrar(){
        $Categorias = Categorias::findAll();
        $this->view(['Categorias' =>$Categorias]);
        $this->view->page_title = 'Cadastrar Sala';
        $this->view->render();
    }
	
    /**
     * Ele retorna um json com o usuario requisitado ou todos
     * @param string $id
     */
    public function Listar($id=''){
        
        /*Salas::findAll(
            ['moderador_id'=>1],
            ['or'=>'moderador_id=null']);
		*/

        $token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
        if(Assert::equalsOrError(Usuarios::findById($token->id)->admin,true)){
            $Salas = ($id != '') ? Salas::findAll(['moderador_id'=>$id]) : Salas::findAll();
        }else{
            $Salas = ['erro'=>'Autenticação é requerida'];
        }
        header("Content-type:application/json");
        echo json_encode($Salas);
    }

    /**
     * @param string $id_sala
     */
    public function Conversar($id_sala = null){
        $token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
        $usuario_id = $token->id;

        if (isset($usuario_id) && isset($id_sala)){
            //Verifica se o usuario esta na mesma sala
            if($token->sala !== $id_sala){
                $token->time_sala = date("H:i:s");
                $token->sala = $id_sala;
            }

            $token->time_ativo = gmdate("H:i:s", (strtotime(date("H:i:s")) - strtotime( $token->time_sala)));
            $Sala = new Salas();
            $Sala->addUsuario($usuario_id, $id_sala);
            Token::saveTokenOnSession('Token',$token);
        }

        $this->view(['id_sala'=>$id_sala,'time_ativo'=>$token->time_ativo]);
        $this->view->page_title = 'Conversar';
        $this->view->render();
    }

    /**
     * @param string $id_sala
     */
    public function Selecionar($id_sala=''){
        $this->view(['id_sala'=>$id_sala]);
        $this->view->page_title = 'Conversar';
        $this->view->render();
    }

    /**
     *
     */
    public function listar_por_relevancia(){
		$Salas = Salas::getRelevantes();
		foreach($Salas as $sala){
			//remove a senha ao enviar por json
			$sala->senha = '';
		}
		echo json_encode($Salas);
    }
    
    public function listSalasByName(){
       $Salas = new Salas();
       $string = $_POST['search'];
       $Salas->findBy("nome","%$string%");
       echo json_encode($Salas);
    }

    /**
     *  Metodo recebe via post Sala{nome,senha e categoria_id}
     *  moderador_id é pego pela sessão
     */
    public function cadastrar_post(){
		$token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
        $json = json_decode(file_get_contents('php://input'), true);
        $Salas = new Salas();
        $Salas->nome          = ($json)? filter_var($json['nome'], FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, 'nome');
        $Salas->senha         = ($json)? md5(filter_var($json['senha'], FILTER_SANITIZE_STRING). SALT) : md5(filter_input(INPUT_POST, 'senha'). SALT);
        $Salas->moderador_id  = $token->id;
        $Salas->categorias_id = ($json)? filter_var($json['categorias_id'], FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, 'categorias_id');
        $Salas->save();
    }

    /**
     * Metodo retorna os usuarios de uma determinada sala
     *
     * @param null $id_sala
     * @param null $count
     */
    public function getUsuarios($id_sala=null, $count=null){
		if ($id_sala){
			$Sala = new Salas($id_sala);
			$Usuarios = $Sala->getUsuarios();
			echo json_encode($Usuarios);
		}
	}

    /**
     *
     * Metodo remove usuario de sala
     * @param null $id_sala
     * @param null $count
     */
	public function sair($id_sala=null){
		if ($id_sala){
			$token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
			$usuario_id = $token->id;
			if ($usuario_id){
				$Sala = new Salas($id_sala);
				$Sala->deleteUsuario($usuario_id);
				echo "Você saiu da sala!";
			}
			else {
				echo "Usuário não logado";
			}
		}
		else {
			echo 'sem ID da sala!';
		}
	}
}
