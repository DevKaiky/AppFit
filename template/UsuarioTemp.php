<?php
namespace template;

class UsuarioTemp implements ITemplate {
    public function cabecalho(){
        // Vamos criar um cabeçalho mais elaborado futuramente
        echo "<!DOCTYPE html><html><head><title>Fitness App</title></head><body>";
        echo "<header><h1>Desafio Fitness</h1></header><main>";
    }

    public function rodape(){
        echo "</main><footer><p>&copy; 2025 - Meu App Fitness</p></footer>";
        echo "</body></html>";
    }
    public function layout($pagina, $dados = null) {
        $this->cabecalho();
        // A variável 'parametro' usada na view original agora se chama 'dados'
        // para maior clareza.
        $parametro = $dados;
        include $_SERVER['DOCUMENT_ROOT'] . "\\mvc\\public\\".$pagina;
        $this->rodape();
    }
}