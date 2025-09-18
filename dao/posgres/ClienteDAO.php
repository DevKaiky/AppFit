<?php
namespace dao\posgres;

use dao\IClienteService;
use generic\MysqlFactory;

class ClienteDAO extends MysqlFactory implements IClienteService {
    // Implementação obrigatória da interface IClienteService
    public function salvar($dados) {
        // Exemplo: espera $dados como array associativo com 'nome' e 'desafio'
        if (isset($dados['id'])) {
            // Atualiza se existir id
            return $this->alterar($dados['id'], $dados['nome'], $dados['desafio']);
        } else {
            // Insere se não existir id
            return $this->inserir($dados['nome'], $dados['desafio']);
        }
    }
    public function listar(){
        $sql = "SELECT * FROM Usuarios";
        $retorno = $this->banco->executar($sql);
        return $retorno;
    }
    public function listarId($id){
        $sql = "SELECT * FROM Usuarios WHERE id = :id";
        $param = [':id' => $id];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }
    public function inserir ($nome, $desafio){
        $sql = "INSERT INTO Usuarios (nome, desafio) VALUES (:nome, :desafio)";
        $param = [':nome' => $nome, ':desafio' => $desafio];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }
    public function alterar($id, $nome, $desafio){
        $sql = "UPDATE Usuarios SET nome = :nome, desafio = :desafio WHERE id = :id";
        $param = [':id' => $id, 
                  ':nome' => $nome,
                  ':desafio' => $desafio];

        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }
}