<?php
class UsuarioController extends Controller
{
    /**
     * @param string $id
     * @param string $name
     */
    public function Cadastrar($id='', $name=''){
        //Manda as variaveis para a view [Cadastrar/id/nome]
        $this->view(['id' =>$id, 'name' =>$name]);

        //Muda o titulo da view <title>Titulo</title>
        $this->view->page_title = 'Cadastrar';

        //Muda o Template do Sistema
        //$this->view->setTemplate('Foundation');
        //Mostra a view, o uso do template pode ser desativado usando render(false,".php,.js,etc..")
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

    /**
     * Ele retorna um json com o usuario requisitado ou todos, sendo necessario Autenticação
     * @param string $id
     */
    public function Listar($id=''){
        $Usuarios = Usuarios::findAll();
        $this->view(['Usuarios'=>$Usuarios]);
        $this->view->render(false);
    }

    /**
     * Metodo Cadastra o Usuario no banco de dados via Formulario "POST"
     */
    public function cadastrar_post(){
        $json = json_decode(file_get_contents('php://input'), true);
        $Usuario = new Usuarios();

        if($json){
            $Usuario->nome  = filter_var($json['nome'], FILTER_SANITIZE_STRING);
            $Usuario->senha = filter_var($json['senha'], FILTER_SANITIZE_STRING);
            $Usuario->email = filter_var($json['email'], FILTER_SANITIZE_STRING);
            $Usuario->foto_perfil = filter_var($json['foto_perfil'], FILTER_SANITIZE_STRING);
            $Usuario->senha = password_hash($Usuario->senha, PASSWORD_BCRYPT);
            $Usuario->admin = "0";
        }else{
            $Usuario->nome  = filter_input(INPUT_POST, 'nome');
            $Usuario->senha = filter_input(INPUT_POST, 'senha');
            $Usuario->email = filter_input(INPUT_POST, 'email');
            $Usuario->foto_perfil = filter_input(INPUT_POST, 'foto_perfil');
            $Usuario->senha = password_hash($Usuario->senha, PASSWORD_BCRYPT);
            $Usuario->admin = "0";
        }

        $Usuario->save($Usuario);
        header('Location:' . '/Usuario/Cadastrar');
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

            if(password_verify($senha,$Usuario['senha'])){
                $erro = "Por favor verifique as informações digitadas";
            }

            if($erro == ""){
                $_SESSION['usuario_id']    = $Usuario['id'];
                $_SESSION['usuario_nome']  = $Usuario['nome'];
                $_SESSION['usuario_email'] = $Usuario['email'];
                $_SESSION['usuario_admin'] = $Usuario['admin'];
                header('Location:' . '/Index/');
            }else{
                header('Location:' . '/Usuario/Login/1');
            }
        }
    }

}