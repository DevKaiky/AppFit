<?php
namespace service;

use dao\mysql\UsuarioDAO;

class UsuarioService {
    
    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function salvarUsuario($dados) {
        if (isset($dados['senha'])) {
            $dados['senha'] = password_hash($dados['senha'], PASSWORD_BCRYPT);
        }
        return $this->usuarioDAO->salvar($dados);
    }
    
    public function listarUsuarios() {
        return $this->usuarioDAO->listar();
    }

    public function listarUsuarioPorId($id) {
        return $this->usuarioDAO->listarId($id);
    }

    public function excluirUsuario($id){
        return $this->usuarioDAO->excluir($id);
    }

    public function verificarLogin($email, $senhaPura) {
        $usuario = $this->usuarioDAO->buscarPorEmail($email);
        if ($usuario && password_verify($senhaPura, $usuario['senha'])) {
            unset($usuario['senha']);
            return $usuario;
        }
        return false;
    }
}