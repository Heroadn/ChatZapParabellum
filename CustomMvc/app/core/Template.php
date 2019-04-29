<?php


class Template
{
    protected $view_template = TEMPLATE_SELECTED;
    protected $css_loaded = false;
    protected $js_loaded = false;

    public function getContent(){
        extract($this->view_data);
        include (VIEW . $this->view_file . '.php');
    }

    public function getNav(){
        include(TEMPLATE . $this->view_template . DIRECTORY_SEPARATOR . 'Nav.php');
    }

    public function getSideNav(){
        include(TEMPLATE . $this->view_template . DIRECTORY_SEPARATOR . 'SideNav.php');
    }

    public function loadCss(){
        if(!$this->css_loaded){
            foreach(unserialize(CSS_HEADER) as $value){
                echo '<link href="'. CSS . $value .'" rel="stylesheet">';
                $this->css_loaded = true;
            }
        }
    }

    public function loadJs(){
        if(!$this->js_loaded) {
            foreach (unserialize(JS_HEADER) as $value) {
                echo '<script src="' . JS . $value . '"></script>';
                $this->js_loaded = true;
            }
        }
    }
}