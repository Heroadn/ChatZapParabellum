<?php


class AjaxController extends Controller{
    private $daoUsuarios;

    public function __construct(){
        $this->daoUsuarios = new DaoUsuarios;
    }

    public function Listar($id_sala=''){
        $Usuarios = $this->daoUsuarios->findAll();
        $this->view(['id_sala' =>$id_sala,'Usuarios'=>$Usuarios],'Tabela');
        $this->view->page_title = 'INDEX';
        $this->view->ajax();
    }

    public function Login(){
        $email = filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha',FILTER_SANITIZE_STRING);
        $Usuario = $this->daoUsuarios->findBy('email',$email);

        if(isset($Usuario)){
            $erro = "";

            if($email != $Usuario->email){
                $erro = "Por favor verifique as informações digitadas";
            }

            if(md5($senha . SALT) != $Usuario->senha){
                $erro = "Por favor verifique as informações digitadas";
            }

            if($erro == ""){
                $this->set('Usuario',$Usuario);
                $this->view([],'Login');
                $this->view->page_title = 'Login';
                $this->view->ajax();
            }else{
                $this->set('Usuario','Erro');
            }
        }

    }

}