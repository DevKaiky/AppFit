<?php
namespace Controller;

use service\DesafioService;
use template\UsuarioTemp;
use template\ITemplate;

class DesafioController {
    
    private ITemplate $template;
    private DesafioService $service;

    public function __construct() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?param=Auth/mostrarFormularioLogin');
            exit;
        }
        $this->template = new UsuarioTemp();
        $this->service = new DesafioService();
    }

    public function listar() {
       // Se o utilizador for um administrador, busca a lista com a contagem de participantes.
        if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin') {
            $desafios = $this->service->listarDesafiosComContagem();
            // Usamos uma view de lista específica para o admin
            $this->template->layout("\\public\\admin\\listar_desafios.php", $desafios);
        } else {
            // Se for um utilizador comum, mantem a lógica antiga de ver a participação.
            $desafios = $this->service->listarDesafiosParaUsuario($_SESSION['usuario_id']);
            $this->template->layout("\\public\\desafio\\listar.php", $desafios);
        }
    }
    public function formulario() {
        // Apenas admins podem aceder ao formulário de criação/edição.
        if ($_SESSION['usuario_tipo'] !== 'admin') {
            header('Location: index.php?param=Desafio/listar');
            exit;
        }
        $dados = null;
        if (isset($_GET['id'])) {
            $dados = $this->service->listarDesafioPorId($_GET['id']);
        }
        $this->template->layout("\\public\\desafio\\formulario.php", $dados);
    }

    public function salvar() {
        if ($_SESSION['usuario_tipo'] !== 'admin') {
            header('Location: index.php?param=Desafio/listar');
            exit;
        }
        $dados = [
            'id' => filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT),
            'titulo' => filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'descricao' => filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'nivel' => filter_input(INPUT_POST, 'nivel', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
        ];
        if (empty($dados['titulo'])) {
             header("Location: index.php?param=Desafio/formulario");
             exit;
        }
        $this->service->salvarDesafio($dados);
        header("Location: index.php?param=Desafio/listar");
        exit;
    }

    public function excluir() {
        if ($_SESSION['usuario_tipo'] !== 'admin') {
            header('Location: index.php?param=Desafio/listar');
            exit;
        }
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

    
    public function detalhes() {
        $desafioId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $usuarioId = $_SESSION['usuario_id'];

        if (!$desafioId) {
            header("Location: index.php?param=Desafio/listar");
            exit;
        }
        $dadosParaView = [
            'desafio' => $this->service->listarDesafioPorId($desafioId),
            'progressos' => $this->service->listarProgressos($usuarioId, $desafioId)
        ];
        $this->template->layout("\\public\\desafio\\detalhes.php", $dadosParaView);
    }

    public function registrarProgresso() {
        $desafioId = filter_input(INPUT_POST, 'desafio_id', FILTER_SANITIZE_NUMBER_INT);
        $usuarioId = $_SESSION['usuario_id'];
        $observacao = filter_input(INPUT_POST, 'observacao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($desafioId && !empty($observacao)) {
            $this->service->registrarProgresso($usuarioId, $desafioId, $observacao);
        }
        header("Location: index.php?param=Desafio/detalhes&id=" . $desafioId);
        exit;
    }
public function cancelarParticipacao() {
        $desafioId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $usuarioId = $_SESSION['usuario_id'];

        if ($desafioId) {
            $this->service->cancelarParticipacao($usuarioId, $desafioId);
        }
        header("Location: index.php?param=Desafio/listar");
        exit;
    }

    public function formularioProgresso() {
        $progressoId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
       
        $desafioId = filter_input(INPUT_GET, 'desafioId', FILTER_SANITIZE_NUMBER_INT);
        $observacao = $_GET['obs'] ?? '';
        
        $dadosParaView = [
            'progresso_id' => $progressoId,
            'desafio_id' => $desafioId,
            'observacao' => $observacao
        ];
        
        $this->template->layout("\\public\\desafio\\formulario_progresso.php", $dadosParaView);
    }

    public function atualizarProgresso() {
        $progressoId = filter_input(INPUT_POST, 'progresso_id', FILTER_SANITIZE_NUMBER_INT);
        $desafioId = filter_input(INPUT_POST, 'desafio_id', FILTER_SANITIZE_NUMBER_INT);
        $observacao = filter_input(INPUT_POST, 'observacao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($progressoId && !empty($observacao)) {
            $this->service->atualizarProgresso($progressoId, $observacao);
        }
        header("Location: index.php?param=Desafio/detalhes&id=" . $desafioId);
        exit;
    }

    public function excluirProgresso() {
        $progressoId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $desafioId = filter_input(INPUT_GET, 'desafioId', FILTER_SANITIZE_NUMBER_INT);

        if ($progressoId) {
            $this->service->excluirProgresso($progressoId);
        }
        header("Location: index.php?param=Desafio/detalhes&id=" . $desafioId);
        exit;
    }

}

