<?php
namespace Controller;

use service\UsuarioService;
use template\UsuarioTemp;
use template\ITemplate;

class AdminUsuarioController {
    private ITemplate $template;
    private UsuarioService $service;

    public function __construct() {
        // Protege TODAS as ações de administração de utilizadores
        if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
            header('Location: index.php?param=Desafio/listar');
            exit;
        }
        $this->template = new UsuarioTemp();
        $this->service = new UsuarioService();
    }

    // Métodos que antes estavam no UsuarioController
    public function listar() {
        $resultado = $this->service->listarUsuarios();
        $this->template->layout("\\public\\usuario\\listar.php"); // Reutilizamos a mesma view
    }

    
    public function formulario() {
        $dados = null;
        if (isset($_GET['id'])) {
            $dados = $this->service->listarUsuarioPorId($_GET['id']);
        }
        // Usa uma nova view de formulário específica para o admin
        $this->template->layout("\\public\\admin\\formulario_usuario.php", $dados);
    }

    
    public function salvar() {
        $dados = [
            'id' => filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT),
            'nome' => $_POST['nome'] ?? '',
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            'senha' => $_POST['senha'],
            'tipo' => filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_FULL_SPECIAL_CHARS) // Permite ao admin mudar o tipo
        ];

        if (!empty($dados['id']) && empty($dados['senha'])) {
            unset($dados['senha']);
        }
        
        $this->service->salvarUsuario($dados);
        header("Location: index.php?param=Admin/Usuario/listar");
        exit;
    }   
    
    public function excluir(){
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {
            $this->service->excluirUsuario($id);
        }
        header("Location: index.php?param=Admin/Usuario/listar");
        exit;
    }
}

