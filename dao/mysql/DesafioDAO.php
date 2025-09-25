<?php
namespace dao\mysql;

use generic\MysqlFactory;

class DesafioDAO extends MysqlFactory {

    public function listarTodos() {
        $sql = "SELECT * FROM desafios";
        return $this->banco->executar($sql);
    }

    public function salvar($dados) {
        if (isset($dados['id']) && !empty($dados['id'])) {
            $sql = "UPDATE desafios SET titulo = :titulo, descricao = :descricao, nivel = :nivel WHERE id = :id";
            $param = [
                ':titulo' => $dados['titulo'],
                ':descricao' => $dados['descricao'],
                ':nivel' => $dados['nivel'],
                ':id' => $dados['id']
            ];
        } else {
            $sql = "INSERT INTO desafios (titulo, descricao, nivel) VALUES (:titulo, :descricao, :nivel)";
            $param = [
                ':titulo' => $dados['titulo'],
                ':descricao' => $dados['descricao'],
                ':nivel' => $dados['nivel']
            ];
        }
        return $this->banco->executar($sql, $param);
    }

    public function listarId($id) {
        $sql = "SELECT * FROM desafios WHERE id = :id";
        $param = [':id' => $id];
        $resultado = $this->banco->executar($sql, $param);
        return $resultado ? $resultado[0] : false;
    }

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
        $sql = "SELECT d.*, p.id IS NOT NULL AS participante
                FROM desafios AS d
                LEFT JOIN participacoes AS p ON d.id = p.desafio_id AND p.usuario_id = :usuario_id";
        
        
        $param = [':usuario_id' => $usuarioId];
        
        return $this->banco->executar($sql, $param);
    }
     public function listarComContagemDeParticipantes() {
        $sql = "SELECT d.*, COUNT(p.id) AS total_participantes
                FROM desafios AS d
                LEFT JOIN participacoes AS p ON d.id = p.desafio_id
                GROUP BY d.id
                ORDER BY d.id DESC";
        
        return $this->banco->executar($sql);
    }
    
    // Métodos de progresso
    public function registrarProgresso($participacaoId, $observacao) {
        $sql = "INSERT INTO progressos (participacao_id, observacao) VALUES (:participacao_id, :observacao)";
        $param = [
            ':participacao_id' => $participacaoId,
            ':observacao' => $observacao
        ];
        return $this->banco->executar($sql, $param);
    }

    public function listarProgressos($participacaoId) {
        $sql = "SELECT * FROM progressos WHERE participacao_id = :participacao_id ORDER BY data_registo DESC";
        $param = [':participacao_id' => $participacaoId];
        return $this->banco->executar($sql, $param);
    }

    public function getParticipacaoId($usuarioId, $desafioId) {
        $sql = "SELECT id FROM participacoes WHERE usuario_id = :usuario_id AND desafio_id = :desafio_id";
        $param = [':usuario_id' => $usuarioId, ':desafio_id' => $desafioId];
        $resultado = $this->banco->executar($sql, $param);
        return $resultado ? $resultado[0]['id'] : false;
    }
     public function cancelarParticipacao($usuarioId, $desafioId) {
        $sql = "DELETE FROM participacoes WHERE usuario_id = :usuario_id AND desafio_id = :desafio_id";
        $param = [
            ':usuario_id' => $usuarioId,
            ':desafio_id' => $desafioId
        ];
        return $this->banco->executar($sql, $param);
    }

    public function atualizarProgresso($progressoId, $observacao) {
        $sql = "UPDATE progressos SET observacao = :observacao WHERE id = :id";
        $param = [
            ':observacao' => $observacao,
            ':id' => $progressoId
        ];
        return $this->banco->executar($sql, $param);
    }

    public function excluirProgresso($progressoId) {
        $sql = "DELETE FROM progressos WHERE id = :id";
        $param = [':id' => $progressoId];
        return $this->banco->executar($sql, $param);
    }
}

