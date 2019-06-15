<?php
namespace core;

class Controller
{
    protected $view;
    protected $template;

    public function view($data = [],$viewName = ""){
        if($viewName == ""){
            $viewName = debug_backtrace()[1]['function'];
        }

        //Nome da pasta em view é igual ao nome de "url" do controller chamado
        $view_folder = str_ireplace('controller', '', get_class($this)) . DIRECTORY_SEPARATOR;
        $this->view = new View($view_folder . $viewName,$data);
        return $this->view;
    }

}