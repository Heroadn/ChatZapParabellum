<?php


class Controller
{
    protected $view;
    protected $view_vars = [];
    protected $template;

    public function view($data = [],$viewName = ""){
        if($viewName == ""){
            $viewName = debug_backtrace()[1]['function'];
        }

        $view_folder = str_replace('Controller', '', get_class($this)) . DIRECTORY_SEPARATOR;
        $data = array_merge($data, $this->view_vars);
        $this->view = new View($view_folder . $viewName,$data);
        return $this->view;
    }

}