<?php
namespace Controller;

use template\UsuarioTemp;
use template\ITemplate;

class AdminController {
    private ITemplate $template;

    public function __construct() {
        // Protege TODAS as ações de administração
        if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
            // Se não for admin, redireciona para a página principal
            header('Location: index.php?param=Desafio/listar');
            exit;
        }
        $this->template = new UsuarioTemp();
    }

    public function dashboard() {
        $this->template->layout("\\public\\admin\\dashboard.php");
    }
}

