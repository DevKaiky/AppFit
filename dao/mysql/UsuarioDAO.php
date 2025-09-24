<?php
namespace dao\mysql;

use dao\IUsuarioService;
use generic\MysqlFactory;

class UsuarioDAO extends MysqlFactory implements IUsuarioService {
    
    public function salvar($dados) {
        if (isset($dados['id']) && !empty($dados['id'])) {
            return $this->alterar($dados);
        } else {
            return $this->inserir($dados);
        }
    }
    
    public function inserir($dados){
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $param = [
            ':nome' => $dados['nome'], 
            ':email' => $dados['email'],
            ':senha' => $dados['senha']
        ];
        return $this->banco->executar($sql, $param);
    }

    public function alterar($dados){
        $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
        $param = [
            ':id' => $dados['id'], 
            ':nome' => $dados['nome'],
            ':email' => $dados['email']
        ];
        // Se uma nova senha foi fornecida, atualiza também
        if (isset($dados['senha'])) {
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
            $param[':senha'] = $dados['senha'];
        }
        return $this->banco->executar($sql, $param);
    }
    
    public function listar(){
        $sql = "SELECT id, nome, email, data_criacao FROM usuarios";
        return $this->banco->executar($sql);
    }

    public function listarId($id){
        $sql = "SELECT id, nome, email, data_criacao FROM usuarios WHERE id = :id";
        $param = [':id' => $id];
        return $this->banco->executar($sql, $param);
    }
    
    public function buscarPorEmail($email){
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $param = [':email' => $email];
        $resultado = $this->banco->executar($sql, $param);
        return $resultado ? $resultado[0] : false;
    }

    public function excluir($id){
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $param = [':id' => $id];
        return $this->banco->executar($sql, $param);
    }
}