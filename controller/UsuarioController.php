<?php
namespace Controller;

use service\UsuarioService;
use template\UsuarioTemp;
use template\ITemplate;

class UsuarioController {
    private ITemplate $template;
    private UsuarioService $service;

    public function __construct() {
        // Apenas o formulário de cadastro é público
        $rotaAtual = $_GET['param'] ?? '';
        if ($rotaAtual !== 'Usuario/formulario' && $rotaAtual !== 'Usuario/salvar' && !isset($_SESSION['usuario_id'])) {
             header('Location: index.php?param=Auth/mostrarFormularioLogin');
             exit;
        }
        
        $this->template = new UsuarioTemp();
        $this->service = new UsuarioService();
    }

    // Ações de um utilizador comum:
    // formulário de cadastro, salvar e ver/editar o próprio perfil.

    public function formulario() {
        // Este formulário agora é apenas para CADASTRO por utilizadores não logados.
        // A edição será feita no perfil.
        $this->template->layout("\\public\\usuario\\formulario.php");
    }
    
    public function salvar() {
        // Lógica de salvar continua praticamente a mesma,
        // mas agora é usada para cadastro e para o próprio perfil.
        $dados = [
            'id' => filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT),
            'nome' => $_POST['nome'] ?? '',
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            'senha' => $_POST['senha']
        ];

        // Validação e lógica de salvar...
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

        // Redirecionamento inteligente
        if (!isset($_SESSION['usuario_id'])) { // Se estava a fazer cadastro
            header("Location: index.php?param=Auth/mostrarFormularioLogin&cadastro=sucesso");
        } else { // Se estava a editar o perfil
            header("Location: index.php?param=Usuario/perfil&sucesso=1");
        }
        exit;
    }
    
    public function perfil() {
        $id = $_SESSION['usuario_id'];
        $dadosDoUsuario = $this->service->listarUsuarioPorId($id);
        $this->template->layout("\\public\\usuario\\perfil.php", $dadosDoUsuario);
    }
}

