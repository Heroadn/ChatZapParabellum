<?php
namespace controller;
use core\Assert;
use core\Controller;
use core\Token;
use core\Upload;
use core\View;
use http\Header;
use model\Salas;
use model\Categorias;
use model\Usuarios;

class HomeController extends Controller
{
  {
      /**
       * @param string $id
       * @param string $name
       */
      public function Inicio($id='', $name=''){
          $this->view(['id' =>$id, 'name' =>$name]);
          $this->view->page_title = 'Inicio';
          $this->view->render();
    }
}
