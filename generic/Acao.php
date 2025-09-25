<?php
namespace generic;

class Acao {
    private $classe;
    private $metodo;

    public function __construct($classe, $metodo) 
    {
     
        $this->classe = "Controller\\" . $classe;
        $this->metodo = $metodo;
    }

    public function executar() {
        // verificação para garantir que a classe existe antes de a instanciar.
        if (class_exists($this->classe)) {
            $obj = new $this->classe();
            $obj->{$this->metodo}();
        } else {
            // Se a classe não for encontrada, mostra um erro claro.
            echo "<h2>Erro Crítico: Controller não encontrado!</h2>";
            echo "<p>A classe <strong>" . htmlspecialchars($this->classe) . "</strong> não foi encontrada. Verifique os namespaces e o autoloading.</p>";
        }
    }
}
