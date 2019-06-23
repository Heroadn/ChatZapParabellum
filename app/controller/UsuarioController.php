<?php
namespace controller;
use core\Controller;
use core\Token;
use core\Assert;
use core\Upload;
use model\Usuarios;

class UsuarioController extends Controller
{
    /**
     * @param string $id
     * @param string $name
     */
    public function Cadastrar($erro=''){
        $this->view(['erro' =>$erro]);
        $this->view->page_title = 'Cadastrar';
        $this->view->render();
    }

    public function Perfil($id=''){
        $Usuario = Usuarios::findById($id);
        $this->view(['Usuario' =>$Usuario]);
        $this->view->page_title = 'Perfil';
        $this->view->render();
    }
    public function Logout($id=''){
        $Usuario = Usuarios::findById($id);
        $this->view(['Usuario' =>$Usuario]);
        $this->view->page_title = 'Logout';
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
        $json = json_decode(file_get_contents('php://input'), true);

        $Usuario = new Usuarios();
        $Usuario->nome  = ($json) ? filter_var($json['nome'],  FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, 'nome');
        $Usuario->senha = ($json) ? filter_var($json['senha'], FILTER_SANITIZE_STRING) : filter_input(INPUT_POST, 'senha');
        $Usuario->email = ($json) ? filter_var($json['email'], FILTER_SANITIZE_EMAIL)  : filter_input(INPUT_POST, 'email');
        $Usuario->foto_perfil = ($json) ? Upload::save('foto_perfil','perfil_'.$Usuario->email.'_') : Upload::save('foto_perfil','perfil_'.$Usuario->email.'_');
        $Usuario->senha = password_hash($Usuario->senha, PASSWORD_BCRYPT);
        $Usuario->admin = "0";

        /*Mensagem de erro*/
        $error = '';

        /*Procura o usuario fornecido pelo email*/
        $isUserRegistered = false;

        /*Verifica o campo nome está vazio*/
        if(empty($Usuario->nome))
        {
            $error = 'nome_vazio';
        }

        /*Verifica o campo nome está vazio*/
        if(empty($Usuario->senha))
        {
            $error = 'senha_vazia';
        }

        /*Verifica o campo nome está vazio*/
        if(empty($Usuario->email))
        {
            $error = 'email_vazio';
        }else
        {
            $isUserRegistered = Usuarios::findBy('email',$Usuario->email);
        }

        /*Verifica se o usuario já existe no banco de dados*/
        if($isUserRegistered)
        {
            $error = 'Conta_ja_existe';
        }

        /* Caso tenha algum erro de consistencia nas informaçoes fornecidas pelo Usuario
         * ele sera redicionado novamente a pagina de cadastro mas
         * sera enviado o erro pela url como '/Usuario/Cadastrar/causa do erro'
         */
        if($error)
        {
            header('Location:' . '/Usuario/Cadastrar/Erro='.$error);
        }
        else
        {
            /* Caso o Usuario não tenha fornecido uma foto, sera atribuida uma foto padrão */
            if(!$Usuario->foto_perfil)
            {
                $Usuario->foto_perfil = IMG . 'ico_zapchat.png';
            }

            $Usuario->save();
            header('Location:' . '/Usuario/Login');
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
                session_start();
            }else{
                header('Location:' . '/Usuario/Login/Erro');
            }
        }
    }
    public function logout_post(){
        unset($_SESSION["Token"]);
        header("Location: /Usuario/Logout");
        echo 'Logout Realizado';
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
    public function delete($id){
        $Usuario = new Usuarios($id);
        $Usuario->delete($id);
    }
}
