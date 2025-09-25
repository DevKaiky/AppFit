<?php
namespace service;

class DesafioService {
    // Simulação de armazenamento (substitua por DAO depois)
    private $desafios = [];

    public function __construct() {
        // Exemplo de desafios iniciais
        $this->desafios = [
            ["id" => 1, "titulo" => "Desafio Corrida", "descricao" => "Corra 5km por dia", "nivel" => "Intermediário"],
            ["id" => 2, "titulo" => "Desafio Flexão", "descricao" => "100 flexões em 1 semana", "nivel" => "Avançado"],
        ];
    }

    // Listar todos os desafios
    public function listarTodos() {
        return $this->desafios;
    }

    // Criar novo desafio
    public function salvar($dados) {
        $novoId = count($this->desafios) + 1;
        $dados['id'] = $novoId;
        $this->desafios[] = $dados;
        return $dados;
    }

    // Buscar desafio por ID
    public function listarId($id) {
        foreach ($this->desafios as $desafio) {
            if ($desafio['id'] == $id) {
                return $desafio;
            }
        }
        return null;
    }

    // Excluir desafio
    public function excluir($id) {
        foreach ($this->desafios as $i => $desafio) {
            if ($desafio['id'] == $id) {
                unset($this->desafios[$i]);
                return true;
            }
        }
        return false;
    }

    // Participar de desafio (simples)
    public function participar($idUsuario, $idDesafio) {
        // Aqui você pode implementar lógica de associação usuário-desafio
        return true;
    }

    // Registrar progresso do usuário
    public function registrarProgresso($idUsuario, $idDesafio, $progresso) {
        // Aqui você pode implementar lógica de registro de progresso
        return true;
    }
}
