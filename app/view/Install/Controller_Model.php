<?php
/** @var String $nome */
return"<?php\n
class ${nome}Controller extends Controller{\n
    public function index(\$id='',\$name=''){
        \$this->view(['id' =>\$id, 'name' =>\$name]);
        \$this->view->page_title = 'Titulo';
        \$this->view->render();
    }\n
}\n";
