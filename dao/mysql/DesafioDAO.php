<?php
namespace dao\mysql;

use generic\MysqlFactory;

class DesafioDAO extends MysqlFactory {

    // Listar todos os desafios
    public function listarTodos() {
        $sql = "SELECT * FROM desafios";
        return $this->banco->executar($sql);
    }

    // Salvar novo desafio ou atualizar um existente
    public function salvar($dados) {
        if (isset($dados['id']) && !empty($dados['id'])) {
            // Atualizar
            $sql = "UPDATE desafios SET titulo = :titulo, descricao = :descricao, nivel = :nivel WHERE id = :id";
            $param = [
                ':titulo' => $dados['titulo'],
                ':descricao' => $dados['descricao'],
                ':nivel' => $dados['nivel'],
                ':id' => $dados['id']
            ];
        } else {
            // Inserir
            $sql = "INSERT INTO desafios (titulo, descricao, nivel) VALUES (:titulo, :descricao, :nivel)";
            $param = [
                ':titulo' => $dados['titulo'],
                ':descricao' => $dados['descricao'],
                ':nivel' => $dados['nivel']
            ];
        }
        return $this->banco->executar($sql, $param);
    }

    // Buscar desafio por ID
    public function listarId($id) {
        $sql = "SELECT * FROM desafios WHERE id = :id";
        $param = [':id' => $id];
        $resultado = $this->banco->executar($sql, $param);
        return $resultado ? $resultado[0] : false;
    }

    // Excluir desafio
    public function excluir($id) {
        $sql = "DELETE FROM desafios WHERE id = :id";
        $param = [':id' => $id];
        return $this->banco->executar($sql, $param);
    }

      
    
    
    public function participar($usuarioId, $desafioId) {
        $sql = "INSERT IGNORE INTO participacoes (usuario_id, desafio_id) VALUES (:usuario_id, :desafio_id)";
        $param = [
            ':usuario_id' => $usuarioId,
            ':desafio_id' => $desafioId
        ];
        return $this->banco->executar($sql, $param);
    }

    public function verificarParticipacao($usuarioId, $desafioId) {
        $sql = "SELECT id FROM participacoes WHERE usuario_id = :usuario_id AND desafio_id = :desafio_id";
        $param = [
            ':usuario_id' => $usuarioId,
            ':desafio_id' => $desafioId
        ];
        $resultado = $this->banco->executar($sql, $param);
        return !empty($resultado);
    }

    public function listarComParticipacao($usuarioId) {
        $sql = "SELECT d.*, 
                       (CASE WHEN p.id IS NOT NULL THEN 1 ELSE 0 END) as participante
                FROM desafios d
                LEFT JOIN participacoes p ON d.id = p.desafio_id AND p.usuario_id = :usuario_id";
        $param = [':usuario_id' => $usuarioId];
        return $this->banco->executar($sql, $param);
    }
}
