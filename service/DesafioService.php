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
      
        return $this->desafioDAO->participar($usuarioId, $desafioId);
    }

     public function registrarProgresso($usuarioId, $desafioId, $observacao) {
        // Primeiro, obtemos o ID da participação
        $participacaoId = $this->desafioDAO->getParticipacaoId($usuarioId, $desafioId);

        if ($participacaoId) {
            return $this->desafioDAO->registrarProgresso($participacaoId, $observacao);
        }
        return false;
    }

    public function listarProgressos($usuarioId, $desafioId) {
        $participacaoId = $this->desafioDAO->getParticipacaoId($usuarioId, $desafioId);

        if ($participacaoId) {
            return $this->desafioDAO->listarProgressos($participacaoId);
        }
        return []; // Retorna um array vazio se não houver participação
    }
    public function listarDesafiosComContagem() {
        return $this->desafioDAO->listarComContagemDeParticipantes();
    }

     public function cancelarParticipacao($usuarioId, $desafioId) {
        return $this->desafioDAO->cancelarParticipacao($usuarioId, $desafioId);
    }

    public function atualizarProgresso($progressoId, $observacao) {
        return $this->desafioDAO->atualizarProgresso($progressoId, $observacao);
    }

    public function excluirProgresso($progressoId) {
        return $this->desafioDAO->excluirProgresso($progressoId);
    }

}