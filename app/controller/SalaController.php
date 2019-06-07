<?php
class SalaController extends Controller
{
    /**
     * @param string $id
     * @param string $name
     */
    public function Cadastrar(){
		$token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
		if (isset($token->id)){
			$Categorias = Categorias::findAll();
			$this->view(['Categorias' =>$Categorias]);
			$this->view->page_title = 'Cadastrar Sala';
			$this->view->render();
		}
		else {
			header('Location: /Usuario/Login/');
		}
    }

    public function Listar($opcao='', $parametro=''){
        $token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
        $isAdmin = isset($token->id) && Assert::equalsOrError(Usuarios::findById($token->id)->admin,true);
        $opcao = strtolower($opcao);
        /*Caso o usuario seja um administrador
        * sera mostrado todas as informações sobre sala assim como informações sensiveis
        * senha, tempo etc.. */

        switch($opcao){
            case 'nome':
                $Salas = Salas::findAll([],['like'=>['nome'=>$parametro]]);
                break;
            case 'categoria':
                $Salas = Salas::listar_por_categoria($parametro);
                break;
            case 'tag':
                $Salas = Salas::findAll([],['like'=>['tags'=>$parametro]]);
                break;
            case 'relevantes':
				$this->update_all_usuarios();
                $Salas = Salas::getRelevantes();
                break;
            case 'todos':
                $Salas = Salas::findAll();
                break;
            case 'usuario':
                $Salas = Salas::listar_por_usuario($parametro);
                break;
			case 'moderador':
                $Salas = Salas::findAll(['moderador_id'=>$parametro]);
                break;
            default:
                $Salas = Salas::findAll();
        }

        if(!$isAdmin) {
            foreach ($Salas as $sala) {
                unset($sala->senha);
            }
        }
        header("Access-Control-Allow-Origin: *");
        header("Content-type:application/json");
        echo json_encode($Salas);
    }

    public function Destaque($id=''){
        $Salas = Salas::getRelevantes();
        $this->view(['Salas' =>$Salas]);
        $this->view->page_title = 'Destaque';
        $this->view->render();
    }

    public function Senha($id=''){
		$this->view(['id' => $id]);
        $this->view->page_title = 'Digite a senha';
        $this->view->render();
    }
    /**
     * @param string $id_sala
     */
    public function Conversar($id_sala = null){
        $token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
		
        if (isset($token->id) && isset($id_sala)){
			$allowed = false;
			$usuario_id = $token->id;
			$Sala = Salas::findAll(['id'=>$id_sala]);
			if (!empty($Sala)){
				$senha_sala = $Sala[0]->senha;
				if ($senha_sala){
					$senha_recebida = filter_input(INPUT_POST, 'senha');
					if (md5($senha_recebida.SALT) == $senha_sala){
						$allowed = true;
					}
					else {
						$allowed = false;
					}
				}
				else {
					$allowed = true;
				}
				if ($allowed){
					if (!$Sala[0]->isBanido($token->id)){
						if ($Sala[0]->moderador_id === $token->id){
							$mod = 1;
						}
						else {
							$mod = 0;
						}
						//Verifica se o usuario esta na mesma sala
						if($token->sala !== $id_sala){
							$token->time_sala = date("H:i:s");
							$token->sala = $id_sala;
						}

						$token->time_ativo = gmdate("H:i:s", (strtotime(date("H:i:s")) - strtotime( $token->time_sala)));
						$Sala = new Salas();
						$Sala->addUsuario($usuario_id, $id_sala);
						Token::saveTokenOnSession('Token',$token);

						$this->view(['id_sala'=>$id_sala,'time_ativo'=>$token->time_ativo,'mod'=>$mod]);
						$this->view->page_title = 'Conversar';
						$this->view->render();		
					}
					else{
						echo 'TÁ BANIDO, VACILÃO!!!!!';
					}
				}
				else {
					header('Location: /Sala/Senha/'.$id_sala);
				}
			}
			else {
				echo 'A SALA NÃO EXISTE!';
			}
        }
		else {
			if (!isset($token->id)){
				header("Location:/Usuario/Login");
			}
			else {
				echo 'INFORME O ID DA SALA!';
			}
		}
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

    /**
     *  Metodo recebe via post Sala{nome,senha e categoria_id}
     *  moderador_id é pego pela sessão
     */
    public function cadastrar_post(){
        $token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
        $json = json_decode(file_get_contents('php://input'), true);
        $Salas = new Salas();
        $Salas->nome          = ($json)? filter_var($json['nome'], FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, 'nome');
		$Salas->senha = ($json)? filter_var($json['senha'], FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, 'senha');
		if ($Salas->senha){
			$Salas->senha = md5($Salas->senha.SALT);
		}
		$Salas->tags = ($json)? filter_var($json['tags'], FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, 'tags');
		$Salas->descricao = ($json)? filter_var($json['descricao'], FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, 'descricao');
		$Salas->foto_sala = ($json) ? Upload::save('foto_sala','sala_'.$Salas->nome.'_') : Upload::save('foto_sala','sala_'.$Salas->nome.'_');
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
			$token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
			$Sala = new Salas($id_sala);
			if (!$Sala->isBanido($token->id)){
				$Usuarios = $Sala->getUsuarios();
				echo json_encode($Usuarios);
			}
			else {
				echo 'b';
			}
		}
	}

	public function update_usuario($id_sala=null){
		if ($id_sala){
            $token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
			//começa a atualizar o last_time do usuário
            $usuario_id = $token->id;
			$Sala = new Salas($id_sala);
			$Sala->updateUsuario($usuario_id);
			
			//verifica se os outros usuários da sala expiraram
			$usuarios = $Sala->getUsuarios();
			foreach($usuarios as $u){
				$last_time = strtotime(date('Y/m/d H:i:s')) - strtotime($u->last_time);
				if ($last_time>60){
					$Sala->deleteUsuario($u->id);
				}
			}
		}
	}
	
	public static function update_all_usuarios(){
		$Salas = Salas::findAll();
		foreach($Salas as $s){
			$Sala = new Salas($s->id);
			$usuarios = $Sala->getUsuarios();
			foreach($usuarios as $u){
				$last_time = strtotime(date('Y/m/d H:i:s')) - strtotime($u->last_time);
				if ($last_time>60){
					$Sala->deleteUsuario($u->id);
				}
			}			
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
	
	public function banirUsuario($id_sala=null, $id_usuario=null){
		if ($id_sala != null && $id_usuario != null){
			$token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
			$Sala = new Salas($id_sala);
			if ($Sala->moderador_id===$token->id){
				$Sala->banirUsuario(intval($id_usuario));
				$Sala->deleteUsuario(intval($id_usuario));
			}
		}
	}
	
	public function desbanirUsuario($id_sala=null, $id_usuario=null){
		if ($id_sala != null && $id_usuario != null){
			$token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
			$Sala = new Salas($id_sala);
			if ($Sala->moderador_id===$token->id){
				$Sala->desbanirUsuario(intval($id_usuario));
			}
		}
	}
}
