<?php
namespace Controller;

use service\DesafioService;
use template\UsuarioTemp; // Reutilizando o mesmo template
use template\ITemplate;

class DesafioController {
    
    private ITemplate $template;
    private DesafioService $service;

    public function __construct() {
        // Protege todas as ações deste controller
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?param=Auth/mostrarFormularioLogin');
            exit;
        }

        $this->template = new UsuarioTemp();
        $this->service = new DesafioService();
    }

    public function listar() {
    // Devemos chamar o método que sabe quem é o utilizador logado
        $desafios = $this->service->listarDesafiosParaUsuario($_SESSION['usuario_id']);
        $this->template->layout("\\public\\desafio\\listar.php", $desafios);
    }

    public function formulario() {
        $dados = null;
        if (isset($_GET['id'])) {
            $dados = $this->service->listarDesafioPorId($_GET['id']);
        }
        $this->template->layout("\\public\\desafio\\formulario.php", $dados);
    }

    public function salvar() {
        // Usar FILTER_SANITIZE_FULL_SPECIAL_CHARS é mais seguro que o obsoleto STRING
        $dados = [
            'id' => filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT),
            'titulo' => filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'descricao' => filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'nivel' => filter_input(INPUT_POST, 'nivel', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
        ];

        if (empty($dados['titulo']) || empty($dados['descricao'])) {
             header("Location: index.php?param=Desafio/formulario"); // Redireciona se dados essenciais faltarem
             exit;
        }

        $this->service->salvarDesafio($dados);
        
        header("Location: index.php?param=Desafio/listar");
        exit;
    }

    public function excluir() {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {
            $this->service->excluirDesafio($id);
        }
        header("Location: index.php?param=Desafio/listar");
        exit;
    }


     
    
    public function participar() {
        $desafioId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $usuarioId = $_SESSION['usuario_id'];

        if ($desafioId) {
            $this->service->participarDesafio($usuarioId, $desafioId);
        }

        header("Location: index.php?param=Desafio/listar");
        exit;
    }
}
