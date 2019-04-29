<?php


class View extends Template
{
    protected $view_file;
    protected $view_data;
    public $page_title;

    public function __construct($view_file,$view_data){
        $this->view_file = $view_file;
        $this->view_data = $view_data;
        $this->page_title = (isset($this->page_title) ? $this->page_title : 'NONE');
    }

    /*Função responsavel por o arquivo de template, e mandando o $this->view_file para o Template*/
    public function render(){
        $path = VIEW . $this->view_file . '.php';
        if(file_exists($path)){
            include(TEMPLATE . $this->view_template . DIRECTORY_SEPARATOR . 'Index.php');
        }
    }

    /*Função que inclui um arquivo sem template, retornando ele por requisição ajax,
     podendo adicionar informações a view, por exemplo*/
    public function ajax($extension = 'php'){
        $path = VIEW . $this->view_file .'.'.$extension;
        if(file_exists($path)){
            extract($this->view_data);
            include($path);
        }
    }

    /*Retorna o Action(Metodo) requisitada pela Url*/
    public function getAction(){
        return (explode('\\',$this->view_file[1]));
    }

    /*Retorna o Controller requisitada pela Url*/
    public function getController(){
        return (explode('\\',$this->view_file[0]));
    }
}