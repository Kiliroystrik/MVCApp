<?php

require_once 'vendor/autoload.php';

use Dotenv\Dotenv;

class Database
{
    private static $instance;

    private $conn;

    private $host;
    private $dbName;
    private $username;
    private $password;

    private function __construct()
    {
        $this->loadCredentials();
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        if (!isset($this->conn)) {
            $this->establishConnection();
        }
        return $this->conn;
    }

    private function establishConnection()
    {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbName}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new RuntimeException("Connection error: " . $e->getMessage());
        }
    }

    private function loadCredentials()
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $this->host = $_ENV['DB_HOST'] ?? null;
        $this->dbName = $_ENV['DB_NAME'] ?? null;
        $this->username = $_ENV['DB_USERNAME'] ?? null;
        $this->password = $_ENV['DB_PASSWORD'] ?? null;

        if (!$this->host || !$this->dbName || !$this->username || !$this->password) {
            throw new RuntimeException('Database credentials not set.');
        }
    }
}
