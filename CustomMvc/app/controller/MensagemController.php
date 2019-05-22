<?php
class MensagemController extends Controller
{
    /**
     * @param string $salas_id
     * @param int $limit
     */
    public function Listar($salas_id = '',$id_mensagem = '', $limit = 10){
        $token  = Auth::getTokenFromHeaders("Authorization");

        //Assert::equalsOrError(Usuarios::findById($token->id)->admin,true)
        // TODO:Usuario so pode visualizar imagens de salas que pertence
        if(true){
            if($salas_id != ''){
                $Mensagens = ($id_mensagem != '')?
                array_reverse(Mensagens::findAll(['salas_id'=>$salas_id,'id'=>$id_mensagem],['DESC'=>'id','>'=>'id','limit'=>$limit]))
                    : array_reverse(Mensagens::findAll(['salas_id'=>$salas_id],['DESC'=>'id','limit'=>$limit]));
            }else{
                $Mensagens = Mensagens::findAll();
            }
        }else{
            $Mensagens = ['erro'=>'Autenticação é requerida'];
        }

        header("Content-type:application/json");
         echo json_encode($Mensagens);
    }

    /**
     * Metodo Cadastra a Sala no banco de dados via Formulario "POST"
     */
    public function cadastrar_post(){
        $token  = Auth::getTokenFromHeaders("Authorization");
        $json = json_decode(file_get_contents('php://input'), true);

        //Cadastrar a mensagem
        $Mensagens = new Mensagens;
        if($json){
            $Mensagens->mensagem    = filter_var($json['mensagem'], FILTER_SANITIZE_STRING);
            $Mensagens->usuarios_id = $token->id;
            $Mensagens->salas_id    = filter_var($json['salas_id'], FILTER_SANITIZE_STRING);
            $Mensagens->para_id = filter_var($json['para_id'], FILTER_SANITIZE_STRING);
            $Mensagens->data        = date("Y-m-d H:i:s");
        }else{
            $image = null;
            if (filter_var(filter_input(INPUT_POST, 'mensagem'), FILTER_VALIDATE_URL)) {
                $image = '<img src="'.filter_input(INPUT_POST, 'mensagem').'">';
            }

            $Mensagens->mensagem = ($image) ? $image : filter_input(INPUT_POST, 'mensagem');
            $Mensagens->salas_id    = filter_input(INPUT_POST, 'salas_id');
            $Mensagens->usuarios_id = $token->id;
            $Mensagens->data        = date("Y-m-d H:i:s");
        }

        $Mensagens->save($Mensagens);
    }
}
