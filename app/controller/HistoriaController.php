<?php

class HistoriaController extends Controller{

    public function index($id='',$name=''){
        $this->view(['id' =>$id, 'name' =>$name]);
        $this->view->page_title = 'Titulo';
        $this->view->render();
    }

}
