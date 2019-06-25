<?php
namespace controller;
use core\Controller;

class IndexController extends Controller
{
    /**
     * @param string $id
     * @param string $name
     */
    public function Index($id='', $name=''){
        $this->view(['id' =>$id, 'name' =>$name]);
        $this->view->page_title = 'Inicio';
        $this->view->render();
    }
}
