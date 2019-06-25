<?php
namespace core;
use controller;
use Exception;

class Application{
    protected $controller  = 'IndexController';
    protected $action = 'Index';
    protected $prams = [];

    /**
     * Carrega se existir o controller juntamento com seu metodo
     * @throws Exception
     */
    public  function __construct(){
        $this->parseURL();
        session_start();

        if(file_exists(CONTROLLER . $this->controller . '.php')){
            $namespaceWithController = 'controller\\'.$this->controller;
            $this->controller = new $namespaceWithController;

            if(method_exists($this->controller,$this->action)){
                /* @version
                * [$this->controller,$this->action] ->class->função a ser chamada
                * $this->prams -> parametros a serem passados a função class->função($this->prams[0],$this->prams[1],...)*/
                call_user_func_array([$this->controller,$this->action],$this->prams);
            }else{
                include(VIEW . 'Error' . DIRECTORY_SEPARATOR . '404.php');//                //throw new Exception('Pagina nao encontrada, verifique se a pasta esta com o nome certo e a url foi digitada corretamente');
            }
        }
    }

    /**
     * Metodo responsavel por fazer um prcessamento da url e retornar o controller e seu metodo(action)
     */
    protected function parseURL(){
        $request = trim($_SERVER['REQUEST_URI'],'/');
        if(!empty($request)){
            $url = explode('/',$request);
            $this->controller = isset($url[0]) ?  $url[0] . 'Controller' : 'indexController';
            $this->action = isset($url[1]) ? $url[1] : 'Cadastrar';

            //Removendo o controller e action do url, e adicionando parametros adicionais na url no prams
            unset($url[0],$url[1]);
            $this->prams = !empty($url) ? array_values($url) : [];
        }
    }
}
