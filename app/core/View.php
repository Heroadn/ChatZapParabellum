<?php
namespace core;
/*
 * @author Benjamin de Castro Azevedo Ponciano
*/

class View extends Template
{
    protected $view_file;
    protected $view_data;
    public $page_title;

    /**
     * View constructor.
     * @param $view_file
     * @param $view_data
     */
    public function __construct($view_file, $view_data){
        $this->view_file = $view_file;//Arquivo a ser chamado
        $this->view_data = $view_data;//Variaveis para a view
        $this->page_title = (isset($this->page_title) ? $this->page_title : 'NONE');//<Title></title>
    }

    /** Função que carrega a view para usuario
     * @param bool $template, caso falso é exibido somente o conteudo sem template
     * @param string $extension, define o tipo de arquivo da view como [.js, .php , etc..]
     */
    public function render($template = true, $extension = '.php'){
        $this->view_file = str_replace('\\','/',$this->view_file);
        $path = VIEW . $this->view_file . $extension;
        $include = TEMPLATE . $this->view_template . DIRECTORY_SEPARATOR . 'Index.php';

        //Caso template seja desativado
        if(!$template){ $include = $path; }

        //Incluindo o arquivo se existir
        if(file_exists($path)){
            extract($this->view_data);
            include($include);
        }
    }

    /**
     * @return array Retorna o Action(Metodo) requisitada pela Url
     */
    public function getAction(){
        return (explode('\\',$this->view_file[1]));
    }

    /**
     * @return array Retorna o Controller requisitada pela Url
     */
    public function getController(){
        return (explode('\\',$this->view_file[0]));
    }
}