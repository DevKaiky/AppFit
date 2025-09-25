<?php

namespace App\Controller;

use template\ITemplate;
use service\DesafioService;


class DesafioController {
    
    private ITemplate $template;
    private DesafioService $service;

  
    public function __construct(DesafioService $service, ITemplate $template) {
        $this->service = $service;
        $this->template = $template;
    }

    /**
     * Protege todas as rotas de desafio para usuários autenticados
     */
    private function requireAuth() {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /public/auth/login.php');
            exit;
        }
    }

    public function listar() {
        try {
            $desafios = $this->service->listarTodos();
            $this->template->layout('desafio/listar.php', ['desafios' => $desafios]);
        } catch (\Exception $e) {
            $this->template->layout('error.php', ['mensagem' => 'Ocorreu um erro ao listar os desafios.']);
        }
    }

    public function criarForm() {
        $this->requireAuth();
        $this->template->layout('desafio/formulario.php');
    }

    public function salvar() {
        $this->requireAuth();
        $dados = [
            'titulo' => filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING),
            'descricao' => filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING),
            'nivel' => filter_input(INPUT_POST, 'nivel', FILTER_SANITIZE_STRING)];

        if (empty($dados['titulo'])) {
            header("Location: index.php?path=desafio/formulario");
            exit;
        }

        try {
            $this->service->salvar($dados);

        } catch (\Exception $e) {
            // Implementar flash message de erro
            // Ex: $_SESSION['mensagem_erro'] = "Erro ao salvar o desafio.";
        }
        
        // Redireciona para a listagem após salvar (Padrão Post-Redirect-Get)
        header("Location: index.php?path=desafio/listar");
        exit;
    }
    
    /**
     * Exclui um desafio.
     * É mais seguro receber o ID via POST para evitar exclusão acidental por CSRF,
     * mas GET é comum para simplicidade. Aqui usamos a rota (ex: /desafio/excluir/15).
     *
     * @param int $id O ID do desafio a ser excluído.
     */
    public function excluir(int $id) {
        $this->requireAuth();
        if ($id > 0) {
            try {
                $this->service->excluir($id);
            } catch (\Exception $e) {
                // $_SESSION['mensagem_erro'] = "Erro ao excluir o desafio.";
            }
        }
        
        // Redireciona para a listagem
        header("Location: index.php?path=desafio/listar");
        exit;
    }

    /**
     * Permite ao usuário logado participar de um desafio
     */
    public function participar($idDesafio) {
        $this->requireAuth();
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /public/auth/login.php');
            exit;
        }
        $idUsuario = $_SESSION['usuario_id'];
        try {
            $this->service->participar($idUsuario, $idDesafio);
        } catch (\Exception $e) {
            // $_SESSION['mensagem_erro'] = "Erro ao participar do desafio.";
        }
        header("Location: index.php?path=desafio/listar");
        exit;
    }

    /**
     * Permite ao usuário logado registrar progresso em um desafio
     */
    public function registrarProgresso($idDesafio) {
        $this->requireAuth();
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /public/auth/login.php');
            exit;
        }
        $idUsuario = $_SESSION['usuario_id'];
        $progresso = filter_input(INPUT_POST, 'progresso', FILTER_SANITIZE_STRING);
        try {
            $this->service->registrarProgresso($idUsuario, $idDesafio, $progresso);
        } catch (\Exception $e) {
            // $_SESSION['mensagem_erro'] = "Erro ao registrar progresso.";
        }
        header("Location: index.php?path=desafio/listar");
        exit;
    }
}