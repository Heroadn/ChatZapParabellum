<?php


class IndexController extends Controller
{
    public function Index($id='',$name=''){
        $this->view(['id' =>$id, 'name' =>$name]);
        $this->view->page_title = 'INDEX';
        $this->view->render();
    }
}