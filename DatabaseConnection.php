<?php


class DatabaseConnection {

    /**
     * @var PDO|null 
     */
    private static ?PDO $connection = null;

    /**
     * @var self|null 
     */
    private static ?self $instance = null;

  
    private string $dsn = "";
    private string $username = "root";
    private string $password = "";
    private array $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lança exceções em caso de erro
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna os resultados como arrays associativos
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Usa prepares nativos do banco
    ];

    private function __construct() {
        
    }

    private function __clone() {
        // Vazio para impedir a clonagem.
    }

    /**
     * * @return self 
     */
    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * * @return PDO A instância da conexão PDO.
     */
    public function connect(): PDO {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO($this->dsn, $this->username, $this->password, $this->options);
                echo "Sucesso na conexão com o banco de dados\n";
            } catch (PDOException $e) {
                die("Erro na conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$connection;
    }

    /**

     * * @param string $sql A consulta SQL a ser executada.
     * @return PDOStatement|false 
     */
    public function query(string $sql) {
        $pdo = $this->connect();
        return $pdo->query($sql);
    }
}