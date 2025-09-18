<?php
namespace generic;

class Acao {
    private $classe;
    private $metodo;
    public function __construct($classe, $metodo) 
    {
        // O namespace do controller já é 'Controller'
        $this->classe = "Controller\\" . $classe;
        $this->metodo = $metodo;
    }

    public function executar() {
        $obj = new $this->classe();
        $obj->{$this->metodo}();
    }
}