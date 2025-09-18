<?php
namespace generic;

class Controller {
    private $arrChamadas = [];
    public function __construct() {
        $this->arrChamadas = [
            // Rotas de Usuário
            'Usuario/listar' => new Acao( 'UsuarioController','listar'),
            'Usuario/formulario' => new Acao( 'UsuarioController','formulario'),
            'Usuario/salvar' => new Acao( 'UsuarioController','salvar'),
            'Usuario/excluir' => new Acao( 'UsuarioController','excluir'),

            // Adicione outras rotas aqui (ex: Desafio/listar)
        ];
    }
    public function verificarChamadas($rota){
        if (isset($this->arrChamadas[$rota])){
            $acao = $this->arrChamadas[$rota];
            $acao->executar();
            return;
        }
        echo "<h1>Erro 404: Rota não encontrada!</h1>";
        echo "<p>A rota '<strong>" . htmlspecialchars($rota) . "</strong>' não foi definida.</p>";
    }
}