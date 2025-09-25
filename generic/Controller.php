<?php
namespace generic;

class Controller {
    private $arrChamadas = [];
    public function __construct() {
        $this->arrChamadas = [
            // --- Rotas Públicas e de Utilizador ---
            'Auth/mostrarFormularioLogin' => new Acao('AuthController', 'mostrarFormularioLogin'),
            'Auth/login' => new Acao('AuthController', 'login'),
            'Auth/logout' => new Acao('AuthController', 'logout'),
            
            'Usuario/formulario' => new Acao('UsuarioController','formulario'),
            'Usuario/salvar' => new Acao('UsuarioController','salvar'),
            'Usuario/perfil' => new Acao('UsuarioController', 'perfil'),

            'Desafio/listar' => new Acao('DesafioController', 'listar'),
            'Desafio/formulario' => new Acao('DesafioController', 'formulario'),
            'Desafio/salvar' => new Acao('DesafioController', 'salvar'),
            'Desafio/excluir' => new Acao('DesafioController', 'excluir'),
            'Desafio/participar' => new Acao('DesafioController', 'participar'),

            // --- ROTAS DE ADMINISTRAÇÃO ---
            'Admin/dashboard' => new Acao('AdminController', 'dashboard'),
            'Admin/Usuario/listar' => new Acao('AdminUsuarioController', 'listar'),
            'Admin/Usuario/excluir' => new Acao('AdminUsuarioController', 'excluir'),
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

