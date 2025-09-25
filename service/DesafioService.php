<?php
namespace service;

use dao\mysql\DesafioDAO;

class DesafioService {
    
    private $desafioDAO;

    public function __construct() {
        $this->desafioDAO = new DesafioDAO();
    }

    public function listarDesafios() {
        return $this->desafioDAO->listarTodos();
    }

    public function salvarDesafio($dados) {
        // Aqui poderiam entrar regras de negócio, como validações.
        return $this->desafioDAO->salvar($dados);
    }

    public function listarDesafioPorId($id) {
        return $this->desafioDAO->listarId($id);
    }

    public function excluirDesafio($id) {
        return $this->desafioDAO->excluir($id);
    }



     public function listarDesafiosParaUsuario($usuarioId) {
        return $this->desafioDAO->listarComParticipacao($usuarioId);
    }

    public function participarDesafio($usuarioId, $desafioId) {
        // A regra de negócio (não participar duas vezes) é tratada pelo "INSERT IGNORE" no DAO
        return $this->desafioDAO->participar($usuarioId, $desafioId);
    }
}
