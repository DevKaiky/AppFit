<?php
namespace dao\mysql;

use dao\IUsuarioService; // Interface renomeada
use generic\MysqlFactory;

class UsuarioDAO extends MysqlFactory implements IUsuarioService {
    
    /**
     * Salva um usuário. Se o ID for fornecido, atualiza. Senão, insere.
     * @param array $dados Dados do usuário (nome, email, senha, e opcionalmente id).
     * @return mixed
     */
    public function salvar($dados) {
        // A senha deve ser criptografada antes de chegar aqui.
        // Veremos isso na camada de Serviço (Service).
        if (isset($dados['id']) && !empty($dados['id'])) {
            return $this->alterar($dados);
        } else {
            return $this->inserir($dados);
        }
    }
    
    /**
     * Insere um novo usuário no banco de dados.
     * @param array $dados Dados do usuário (nome, email, senha).
     * @return mixed
     */
    public function inserir($dados){
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $param = [
            ':nome' => $dados['nome'], 
            ':email' => $dados['email'],
            ':senha' => $dados['senha'] // Senha já deve vir com hash
        ];
        return $this->banco->executar($sql, $param);
    }

    /**
     * Altera os dados de um usuário existente.
     * @param array $dados Dados do usuário (id, nome, email).
     * @return mixed
     */
    public function alterar($dados){
        // Nota: Geralmente não se altera a senha junto com outros dados.
        // Seria uma função separada de "alterar senha".
        $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
        $param = [
            ':id' => $dados['id'], 
            ':nome' => $dados['nome'],
            ':email' => $dados['email']
        ];
        return $this->banco->executar($sql, $param);
    }
    
    /**
     * Lista todos os usuários.
     * @return array
     */
    public function listar(){
        $sql = "SELECT id, nome, email, data_criacao FROM usuarios";
        return $this->banco->executar($sql);
    }

    /**
     * Busca um usuário pelo seu ID.
     * @param int $id
     * @return array
     */
    public function listarId($id){
        $sql = "SELECT id, nome, email, data_criacao FROM usuarios WHERE id = :id";
        $param = [':id' => $id];
        return $this->banco->executar($sql, $param);
    }
    
    /**
     * Busca um usuário pelo seu email (para login).
     * @param string $email
     * @return array
     */
    public function buscarPorEmail($email){
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $param = [':email' => $email];
        return $this->banco->executar($sql, $param);
    }

    /**
     * Exclui um usuário do banco de dados.
     * @param int $id
     * @return mixed
     */
    public function excluir($id){
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $param = [':id' => $id];
        return $this->banco->executar($sql, $param);
    }
}