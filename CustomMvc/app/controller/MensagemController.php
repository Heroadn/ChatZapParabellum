<?php
class MensagemController extends Controller
{
    /**
     * @param string $salas_id
     * @param int $limit
     */
    public function Listar($salas_id = '',$id_mensagem = '', $limit = 10){
        if($salas_id != ''){
            if($id_mensagem != ''){
                $Mensagens = array_reverse(Mensagens::findAll(['salas_id'=>$salas_id,'id'=>$id_mensagem],['DESC'=>'id','>'=>'id','limit'=>$limit]));
            }else{
                $Mensagens = array_reverse(Mensagens::findAll(['salas_id'=>$salas_id],['DESC'=>'id','limit'=>$limit]));
            }
        }else{
            $Mensagens = Mensagens::findAll();
        }

        //if($id_mensagem != '' ) $Mensagens =  Mensagens::findAll(['salas_id'=>$salas_id,'id'=>$id_mensagem],['DESC'=>'id','>'=>'id','limit'=>$limit]);
        echo json_encode($Mensagens);
    }

    /**
     * Metodo Cadastra a Sala no banco de dados via Formulario "POST"
     */
    public function cadastrar_post(){
        if(!isset($_SESSION['usuario_id'])) {header("Location:/Usuario/Login");}
        $json = json_decode(file_get_contents('php://input'), true);

        //Cadastrar a mensagem
        $Mensagens = new Mensagens;
        if($json){
            $Mensagens->mensagem    = filter_var($json['mensagem'], FILTER_SANITIZE_STRING);
            $Mensagens->usuarios_id = $_SESSION['usuario_id'];
            $Mensagens->salas_id    = filter_var($json['salas_id'], FILTER_SANITIZE_STRING);
            $Mensagens->data        = date("Y-m-d H:i:s");
        }else{
            if (filter_var(filter_input(INPUT_POST, 'mensagem'), FILTER_VALIDATE_URL)) {
                $mensage = filter_input(INPUT_POST, 'mensagem');
                //if(strpos('Image: ', $mensage) == true) {
                    $image = '<img src="'.filter_input(INPUT_POST, 'mensagem').'">';;
                //}
                //https://www.w3schools.com/images/w3schools_green.jpg
            }

            $Mensagens->mensagem = ($image) ? $image : filter_input(INPUT_POST, 'mensagem');
            $Mensagens->salas_id    = filter_input(INPUT_POST, 'salas_id');
            $Mensagens->usuarios_id = $_SESSION['usuario_id'];
            $Mensagens->data        = date("Y-m-d H:i:s");
        }

        $Mensagens->save($Mensagens);
    }
}
