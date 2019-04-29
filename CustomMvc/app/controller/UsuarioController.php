<?php
/* Local das Paginas = view/Usuario/
 * Url =  site/Usuario*/
class UsuarioController extends Controller
{
    private $daoUsuarios;

    //Inicializa a interface entre modelo e o banco de dados
    public function __construct(){
        $this->daoUsuarios = new DaoUsuarios;
    }

    public function Cadastrar($id='',$name=''){
        //Manda as variaveis para a view
        $this->view(['id' =>$id, 'name' =>$name]);

        //Muda o titulo da view <title>Titulo</title>
        $this->view->page_title = 'Cadastrar';

        //Mostra a view para o usuario site/Usuario/Cadastrar
        $this->view->render();
    }

    public function Login($id='',$name=''){
        //Manda as variaveis para a view
        $this->view(['id' =>$id, 'name' =>$name]);

        //Muda o titulo da view <title>Titulo</title>
        $this->view->page_title = 'Login';

        //Mostra a view para o usuario site/Usuario/Login
        $this->view->render();
    }

    public function Listar($id='',$name=''){
        //Seleciona todos os Usuarios do banco de dados
        $Usuarios = $this->daoUsuarios->findAll();

        //Manda as variaveis para a view
        $this->view(['id' =>$id, 'name' =>$name,'Usuarios' => $Usuarios]);

        //Muda o titulo da view <title>Titulo</title>
        $this->view->page_title = 'Listar';

        //Mostra a view para o usuario site/Usuario/Listar
        $this->view->render();
    }

    /*Metodo Cadastra o Usuario no banco de dados via Formulario "POST"*/
    public function cadastrar_post(){
        $Usuario = new Usuarios();
        $Usuario->nome  = filter_input(INPUT_POST, 'nome');
        $Usuario->senha = filter_input(INPUT_POST, 'senha');
        $Usuario->email = filter_input(INPUT_POST, 'email');
        $Usuario->admin = filter_input(INPUT_POST, 'admin');
        $Usuario->foto_perfil = filter_input(INPUT_POST, 'foto_perfil');
        $Usuario->senha = md5($Usuario->senha . SALT);
        $this->daoUsuarios->save($Usuario);
        header('Location:' . '/Usuario/Cadastrar');
    }

    /*Metodo Cadastra o Usuario no banco de dados via Json "POST"*/
    public function cadastrar_json(){
        //Recebe o arquivo do tipo json
        $json = json_decode(file_get_contents('php://input'), true);
        //Salva no banco de dados cada usuario recebido
        $Usuario = new Usuarios();
        $Usuario->nome  = filter_var($json['nome'], FILTER_SANITIZE_STRING);
        $Usuario->senha = filter_var($json['senha'], FILTER_SANITIZE_STRING);
        $Usuario->email = filter_var($json['email'], FILTER_SANITIZE_STRING);
        $Usuario->foto_perfil = filter_var($json['foto_perfil'], FILTER_SANITIZE_STRING);
        $Usuario->senha = md5($Usuario->senha . SALT);
        $Usuario->admin = "0";#Usuario padrao
        $this->daoUsuarios->save($Usuario);
    }

    /*Ele retorna um json com o usuario requisitado ou todos, nao sendo necessario Autenticação*/
    public function listar_json($id=''){
        //Por padrao carrega todos os usuarios
        $Usuarios = $this->daoUsuarios->findAll();

        //Caso seja informado id
        if($id != ''){$Usuarios = $this->daoUsuarios->findBy('id',$id);}

        //Mandado arquivo response body "Json"
        echo json_encode($Usuarios);
    }

    /*Ele retorna um json com o usuario requisitado ou todos, sendo necessario Autenticação*/
    public function listar_auth($id=''){
        //Por padrao carrega todos os usuarios
        $Usuarios = $this->daoUsuarios->findAll();

        //Caso seja informado id
        if($id != ''){$Usuarios = $this->daoUsuarios->findBy('id',$id);}

        //Mandado variaveis para view
        $this->view(['id'=>$id,'Usuarios'=>$Usuarios],"ListarAuth")->ajax();
    }

    /*Metodo Autentica o usuario de acordo com o email e senha*/
    public function login_post(){
        $email = filter_input(INPUT_POST, 'email');
        $senha = filter_input(INPUT_POST, 'senha');
        $Usuario = $this->daoUsuarios->findBy('email',$email);

        if(isset($Usuario)){
            $erro = "";

            if($email != $Usuario->email){
                $erro = "Por favor verifique as informações digitadas";
            }

            if( md5($senha . SALT) != $Usuario->senha){
                $erro = "Por favor verifique as informações digitadas";
            }

            if($erro == ""){
                $_SESSION['usuario_id']    = $Usuario->id;
                $_SESSION['usuario_nome']  = $Usuario->nome;
                $_SESSION['usuario_email'] = $Usuario->email;
                $_SESSION['usuario_admin'] = $Usuario->admin;
                header('Location:' . '/Usuario/Login/0');
            }else{
                header('Location:' . '/Usuario/Login/1');
            }
        }
    }
}