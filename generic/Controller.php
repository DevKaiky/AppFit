<?php
namespace generic;
use generic\Acao;
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
            'Desafio/detalhes' => new Acao('DesafioController', 'detalhes'),
            'Desafio/registrarProgresso' => new Acao('DesafioController', 'registrarProgresso'),
            'Desafio/cancelarParticipacao' => new Acao('DesafioController', 'cancelarParticipacao'),
            'Desafio/formularioProgresso' => new Acao('DesafioController', 'formularioProgresso'),
            'Desafio/atualizarProgresso' => new Acao('DesafioController', 'atualizarProgresso'),
            'Desafio/excluirProgresso' => new Acao('DesafioController', 'excluirProgresso'),

            // --- ROTAS DE ADMINISTRAÇÃO ---
            'Admin/dashboard' => new Acao('AdminController', 'dashboard'),
            'Admin/Usuario/listar' => new Acao('AdminUsuarioController', 'listar'),
            'Admin/Usuario/excluir' => new Acao('AdminUsuarioController', 'excluir'),
            'Admin/Usuario/formulario' => new Acao('AdminUsuarioController', 'formulario'), 
            'Admin/Usuario/salvar' => new Acao('AdminUsuarioController', 'salvar'),    
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

