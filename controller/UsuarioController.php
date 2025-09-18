<?php
namespace Controller;

use service\UsuarioService;
use template\UsuarioTemp; // Template renomeado
use template\ITemplate;

class UsuarioController {
    private ITemplate $template;
    private UsuarioService $service;

    public function __construct() {
        $this->template = new UsuarioTemp();
        $this->service = new UsuarioService();
    }

    /**
     * Ação: Listar todos os usuários
     */
    public function listar() {
        $resultado = $this->service->listarUsuarios();
        $this->template->layout("\\public\\usuario\\listar.php", $resultado);
    }

    /**
     * Ação: Exibir formulário de cadastro/edição de usuário
     */
    public function formulario() {
        $dados = null;
        if (isset($_GET['id'])) {
            $dados = $this->service->listarUsuarioPorId($_GET['id']);
        }
        $this->template->layout("\\public\\usuario\\formulario.php", $dados);
    }
    
    /**
     * Ação: Salvar (inserir ou atualizar) um usuário
     */
    public function salvar() {
        // Sanitizar inputs é uma boa prática!
        $dados = [
            'id' => filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT),
            'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING),
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            'senha' => $_POST['senha'] // Não sanitizar senha para não alterar os caracteres
        ];

        // Se for uma inserção, a senha é obrigatória
        if (empty($dados['id']) && empty($dados['senha'])) {
            die("Erro: A senha é obrigatória para cadastrar um novo usuário.");
            // O ideal é redirecionar com uma mensagem de erro.
        }

        // Se for uma alteração e a senha estiver vazia, não a atualizamos.
        if (!empty($dados['id']) && empty($dados['senha'])) {
            unset($dados['senha']); // Remove a chave para não tentar atualizar a senha
        }

        $this->service->salvarUsuario($dados);

        // Redireciona para a lista de usuários
        header("Location: index.php?param=Usuario/listar");
        exit;
    }

    /**
     * Ação: Excluir um usuário
     */
    public function excluir(){
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {
            $this->service->excluirUsuario($id);
        }
        header("Location: index.php?param=Usuario/listar");
        exit;
    }
}