<?php
namespace generic;

class MysqlSingleton{
    private static $instance = null;
    private $conexao = null;
    private $dsn = 'mysql:host=localhost;dbname=fitness;charset=utf8';
    private $usuario = 'root';
    private $senha = '';
    
    private function __construct() {
        if($this->conexao == null){
            try {
                
                $opcoes = [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ];
                $this->conexao = new \PDO($this->dsn, $this->usuario, $this->senha, $opcoes);
            } catch (\PDOException $e) {
                // Se a ligação falhar, mostra uma mensagem de erro clara.
                die("Erro na ligação à base de dados: " . $e->getMessage());
            }
        }   
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new MysqlSingleton();
        }
        return self::$instance;
    }

    public function executar($query, $param = array()) {
        if ($this->conexao){
            $sth = $this->conexao->prepare($query);
            foreach ($param as $k => $v) {
                $tipo = is_int($v) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
                $sth->bindValue($k, $v, $tipo);
            }
            $sth->execute();
            return $sth->fetchAll();
        }
        return [];
    }
}

