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
            'Usuario/perfil' => new Acao('UsuarioController', 'perfil'),

            // Rotas de Autenticação
            'Auth/mostrarFormularioLogin' => new Acao('AuthController', 'mostrarFormularioLogin'),
            'Auth/login' => new Acao('AuthController', 'login'),
            'Auth/logout' => new Acao('AuthController', 'logout'),

            // Futuras rotas do seu parceiro (ex: Desafio/listar)
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