<?php
class Database
{
    protected $connection = null;
    public function __construct() {
        $dsn = 'mysql:host=localhost;dbname='.DB_DATABASE_NAME.';charset=utf8mb4';
        
        try {
            $this->connection = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
