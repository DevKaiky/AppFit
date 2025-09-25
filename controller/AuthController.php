<?php
namespace Controller;

use service\UsuarioService;
use template\UsuarioTemp;

class AuthController {

    private $usuarioService;
    private $template;

    public function __construct() {
        $this->usuarioService = new UsuarioService();
        $this->template = new UsuarioTemp();
    }

    public function mostrarFormularioLogin() {
        $this->template->layout("\\public\\auth\\login.php");
    }

    public function login() {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = $_POST['senha'] ?? '';

        if (!$email || empty($senha)) {
            header("Location: index.php?param=Auth/mostrarFormularioLogin&erro=1");
            exit;
        }

        $usuario = $this->usuarioService->verificarLogin($email, $senha);

        if ($usuario) {
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_tipo'] = $usuario['tipo']; 
            
            // Redireciona para a lista de desafios, que é a página principal para todos
            header("Location: index.php?param=Desafio/listar");
            exit;
        } else {
            header("Location: index.php?param=Auth/mostrarFormularioLogin&erro=2");
            exit;
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?param=Auth/mostrarFormularioLogin");
        exit;
    }
}