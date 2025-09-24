<?php
namespace Controller;

use service\UsuarioService;
use template\UsuarioTemp;
use template\ITemplate;

class UsuarioController {
    private ITemplate $template;
    private UsuarioService $service;

    public function __construct() {
        $rotaAtual = $_GET['param'] ?? '';
        $rotasPublicas = ['Auth/mostrarFormularioLogin', 'Auth/login', 'Usuario/formulario', 'Usuario/salvar'];

        if (!in_array($rotaAtual, $rotasPublicas) && !isset($_SESSION['usuario_id'])) {
            header('Location: index.php?param=Auth/mostrarFormularioLogin');
            exit;
        }
        
        $this->template = new UsuarioTemp();
        $this->service = new UsuarioService();
    }

    public function listar() {
        $resultado = $this->service->listarUsuarios();
        $this->template->layout("\\public\\usuario\\listar.php", $resultado);
    }

    public function formulario() {
        $dados = null;
        if (isset($_GET['id'])) {
            if (!isset($_SESSION['usuario_id'])) {
                header('Location: index.php?param=Auth/mostrarFormularioLogin');
                exit;
            }
            $dados = $this->service->listarUsuarioPorId($_GET['id']);
        }
        $this->template->layout("\\public\\usuario\\formulario.php", $dados);
    }
    
    public function salvar() {
        $dados = [
            'id' => filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT),
            'nome' => $_POST['nome'] ?? '',
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            'senha' => $_POST['senha']
        ];

        if (empty($dados['id']) && empty($dados['senha'])) {
            die("Erro: A senha é obrigatória para cadastrar um novo usuário.");
        }

        if (!empty($dados['id']) && empty($dados['senha'])) {
            unset($dados['senha']);
        }

        if (!empty($dados['id']) && isset($_SESSION['usuario_id']) && $dados['id'] == $_SESSION['usuario_id']) {
            $_SESSION['usuario_nome'] = $dados['nome'];
        }

        $this->service->salvarUsuario($dados);

        if (!empty($dados['id']) && isset($_SESSION['usuario_id']) && $dados['id'] == $_SESSION['usuario_id']) {
             header("Location: index.php?param=Usuario/perfil&sucesso=1");
        } else {
             header("Location: index.php?param=Usuario/listar");
        }
        exit;
    }
    
    public function excluir(){
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {
            $this->service->excluirUsuario($id);
        }
        header("Location: index.php?param=Usuario/listar");
        exit;
    }

    public function perfil() {
        $id = $_SESSION['usuario_id'];
        $dadosDoUsuario = $this->service->listarUsuarioPorId($id);
        $this->template->layout("\\public\\usuario\\perfil.php", $dadosDoUsuario);
    }
}