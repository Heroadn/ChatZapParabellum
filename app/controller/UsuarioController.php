<?php
namespace controller;
use core\Controller;
use core\Token;
use core\Assert;
use core\Upload;
use Facebook\Facebook;
use model\Usuarios;

class UsuarioController extends Controller
{
    /**
     * @param string $id
     * @param string $name
     */
    public function Cadastrar($id='', $name=''){
        $this->view(['id' =>$id, 'name' =>$name]);
        $this->view->page_title = 'Cadastrar';
        $this->view->render();
    }

    public function Perfil($id=''){
        $Usuario = Usuarios::findById($id);
        $this->view(['Usuario' =>$Usuario]);
        $this->view->page_title = 'Perfil';
        $this->view->render();
    }

    /**
     * @param string $id
     * @param string $name
     */
    public function Login($id='', $name=''){
        //Manda as variaveis para a view
        $this->view(['id' =>$id, 'name' =>$name]);

        //Muda o titulo da view <title>Titulo</title>
        $this->view->page_title = 'Login';

        //Mostra a view para o usuario site/Usuario/Login
        $this->view->render();
    }

    public function Alterar($id=''){
        $Usuario = Usuarios::findById($id);
        $this->view(['Usuario' =>$Usuario]);
        $this->view->page_title = 'Perfil';
        $this->view->render();
    }

    /**
     * Ele retorna um json com o usuario requisitado ou todos, sendo necessario Autenticação
     * @param string $id
     */
    public function Listar($opcao='', $parametro=1,$limit = 10){
        $token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
        $isAdmin = isset($token->id) && Assert::equalsOrError(Usuarios::findById($token->id)->id,true);
        $opcao = strtolower($opcao);

        //Paginação
        $start = intval($parametro);
        $page = ($start * $limit) - $limit;
        $size = 0;

        switch($opcao){
            case 'id':
                $Usuarios = Usuarios::findAll(['id'=>$parametro]);
                $size = ceil(Usuarios::count() / $limit);
                break;
            case 'nome':
                $Usuarios = Usuarios::findAll([],['like'=>['nome'=>$parametro]]);
                $size = ceil(Usuarios::count() / $limit);
                break;
            default:
                $Usuarios = Usuarios::findAll([],['limit'=>['start'=>$page,'limit'=>$limit]]);
                $size = ceil(Usuarios::count() / $limit);
        }

        if(!$isAdmin) {
            foreach ($Usuarios as $usuario) {
                unset($usuario->senha);
                unset($usuario->admin);
            }
        }
        header("Access-Control-Allow-Origin: *");
        header("Content-type:application/json");
        echo json_encode(array('Usuarios'=>$Usuarios,'pag'=>['page'=>($page / $limit) + 1,'size'=>$size]));
    }

    /**
     * Metodo Cadastra o Usuario no banco de dados via Formulario "POST"
     */
    public function cadastrar_post(){
        //foto_perfil
        $json = json_decode(file_get_contents('php://input'), true);

        $Usuario = new Usuarios();
        $Usuario->nome  = ($json) ? filter_var($json['nome'],  FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, 'nome');
        $Usuario->senha = ($json) ? filter_var($json['senha'], FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, 'senha');
        $Usuario->email = ($json) ? filter_var($json['email'], FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, 'email');
        $Usuario->foto_perfil = ($json) ? Upload::save('foto_perfil','perfil_'.$Usuario->email.'_') : Upload::save('foto_perfil','perfil_'.$Usuario->email.'_');
        $Usuario->senha = password_hash($Usuario->senha, PASSWORD_BCRYPT);
        $Usuario->admin = "0";

        $fromDb = Usuarios::findBy('email',$Usuario->email);

        if($Usuario->foto_perfil === false || !isset($Usuario->nome) || !isset($Usuario->senha) || !isset($Usuario->email) || $fromDb !== false){
            header('Location:' . '/Usuario/Cadastrar/Erro=1');
        }else{
            $Usuario->save();
            header('Location:' . '/Usuario/Cadastrar');
        }
    }

    /**
    * Metodo Autentica o usuario de acordo com o email e senha
    */
    public function login_post(){
        $email = filter_input(INPUT_POST, 'email');
        $senha = filter_input(INPUT_POST, 'senha');
        $Usuario = Usuarios::findBy('email',$email);

        if(isset($Usuario)){
            $erro = "";

            if($email != $Usuario['email']){
                $erro = "Por favor verifique as informações digitadas";
            }

            if(!password_verify($senha,$Usuario['senha'])){
                $erro = "Por favor verifique as informações digitadas";
            }

            if($erro == ""){
                $payload = [
                    'id'   =>$Usuario['id'],
                    'email'=>$Usuario['email'],
                    'sala'=>null,
                    'time_sala'=> null,
                    'time_ativo'=> null
                ];

                $_SESSION['Token'] = Token::encode($payload);
                header('Location:' . '/Usuario/Perfil/'.$Usuario['id']);
            }else{
                header('Location:' . '/Usuario/Login/Erro');
            }
        }
    }

    public function alterar_post(){
        //foto_perfil
        $json = json_decode(file_get_contents('php://input'), true);
        $token  = Token::getTokenFromHeadersOrSession('Token','Authorization');
        $isAdmin = isset($token->id) && Assert::equalsOrError(Usuarios::findById($token->id)->id,true);

        $id = $token->id;

        $Usuario = Usuarios::findById($id);
        $Usuario->nome  = ($json) ? filter_var($json['nome'],  FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, 'nome');
        $Usuario->senha = ($json) ? filter_var($json['senha'], FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, 'senha');
        $Usuario->email = ($json) ? filter_var($json['email'], FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, 'email');
        $Usuario->foto_perfil = ($json) ? Upload::save('foto_perfil','perfil_'.$Usuario->email.'_') : Upload::save('foto_perfil','perfil_'.$Usuario->email.'_');
        $Usuario->senha = password_hash($Usuario->senha, PASSWORD_BCRYPT);
        $Usuario->admin = "0";

        $fromDb = Usuarios::findBy('email',$Usuario->email);

        var_dump($Usuario);
        $Usuario->save();

        // header('Location:' . '/Usuario/Perfil/'. $token->id);

    }



}
