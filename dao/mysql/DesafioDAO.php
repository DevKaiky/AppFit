<?php
namespace dao\mysql;

class DesafioDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Listar todos os desafios
    public function listarTodos() {
        $sql = "SELECT * FROM desafios";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Salvar novo desafio
    public function salvar($dados) {
        $stmt = $this->conn->prepare("INSERT INTO desafios (titulo, descricao, nivel) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $dados['titulo'], $dados['descricao'], $dados['nivel']);
        $stmt->execute();
        return $this->conn->insert_id;
    }

    // Buscar desafio por ID
    public function listarId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM desafios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Excluir desafio
    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM desafios WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Participar de desafio
    public function participar($idUsuario, $idDesafio) {
        $stmt = $this->conn->prepare("INSERT INTO usuario_desafio (id_usuario, id_desafio) VALUES (?, ?)");
        $stmt->bind_param("ii", $idUsuario, $idDesafio);
        return $stmt->execute();
    }

    // Registrar progresso do usuário
    public function registrarProgresso($idUsuario, $idDesafio, $progresso) {
        $stmt = $this->conn->prepare("INSERT INTO progresso (id_usuario, id_desafio, progresso) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $idUsuario, $idDesafio, $progresso);
        return $stmt->execute();
    }
}
