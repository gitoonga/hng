<?php
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "dc[]";
    private $dbname = "hng1";
    private $charset = "utf8mb4";

    private $pdo;
    private $stmt;

    public function __construct()
    {
        $conn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";

        try {
            $this->pdo = new PDO($conn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function query($sql)
    {
        $this->stmt = $this->pdo->prepare($sql);
    }

    private function typeGen($value)
    {
        return (function () use ($value) {
            yield PDO::PARAM_INT => is_int($value);
            yield PDO::PARAM_BOOL => is_bool($value);
            yield PDO::PARAM_NULL => is_null($value);
            yield PDO::PARAM_STR => is_string($value);
        })()->key();
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            $type = $this->typeGen($value);
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function bindParams($params)
    {
        foreach ($params as $param => $value) {
            $this->bind($param, $value);
        }
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function resultSet()
    {
        
        $this->execute();
        // $this->stmt->debugDumpParams(); 
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}
