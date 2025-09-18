<?php
namespace service;

use dao\mysql\UsuarioDAO;

class UsuarioService {
    
    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function salvarUsuario($dados) {
        // Validação dos dados (ex: verificar se email é válido, etc.) pode ser feita aqui.

        // Criptografar a senha antes de salvar
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
}