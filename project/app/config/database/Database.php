<?php
namespace project\app\config\database;

use PDO;
use PDOException;

class Database {
    private string $host;
    private string $user;
    private string $pass;
    private string $dbname;
    private ?PDO $conn = null;

    public function __construct() {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "developer";
        $this->dbname = "tasks_db";
    }

    public function connect(): PDO {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbname}",
                    $this->user,
                    $this->pass
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                error_log("Erro ao conectar ao banco: " . $e->getMessage());
                throw new PDOException("Erro ao conectar ao banco de dados: " . $e->getMessage());
            }
        }
        return $this->conn;
    }

    public function disconnect(): void {
        $this->conn = null;
    }
}
