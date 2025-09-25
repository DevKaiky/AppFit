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
        // Inicia a query base
        $sql = "UPDATE usuarios SET nome = :nome, email = :email";
        $param = [
            ':id' => $dados['id'], 
            ':nome' => $dados['nome'],
            ':email' => $dados['email']
        ];
        
        // Adiciona a atualização da senha se ela for fornecida
        if (!empty($dados['senha'])) {
            $sql .= ", senha = :senha";
            $param[':senha'] = $dados['senha'];
        }

        // Adiciona a atualização do tipo se ele for fornecido (ação do admin)
        if (isset($dados['tipo'])) {
            $sql .= ", tipo = :tipo";
            $param[':tipo'] = $dados['tipo'];
        }

        $sql .= " WHERE id = :id";
        
        return $this->banco->executar($sql, $param);
    }
    
    public function listar(){
    
        $sql = "SELECT id, nome, email, tipo, data_criacao FROM usuarios";
        return $this->banco->executar($sql);
    }

    public function listarId($id){

        $sql = "SELECT id, nome, email, tipo, data_criacao FROM usuarios WHERE id = :id";
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
