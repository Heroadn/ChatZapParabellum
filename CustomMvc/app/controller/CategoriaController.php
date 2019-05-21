<?php

class CategoriaController extends Controller
{
    /**
     * @param string $id
     * @param string $name
     */
    public function Cadastrar($id='', $name=''){
        //view(nomeView,paramentros /id/name);
        $this->view(['id' =>$id, 'name' =>$name]);
        //Titulo da Pagina
        $this->view->page_title = 'Cadastrar Categoria';
        //Carrega a View
        $this->view->render();
    }

    /**
     * @param string $id
     */
    public function Listar($id=''){
        $Categorias = ($id != '') ? Categorias::findById($id) : Categorias::findAll() ;
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
}
