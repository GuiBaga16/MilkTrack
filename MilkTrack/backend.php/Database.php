<?php

require_once __DIR__ . '/Env.php';
class Database
{
    public $connection; // conexão PDO acessada pelo DAO

    public function __construct()
    {
        $host = getenv('DB_HOST') ?: 'localhost';
        $porta = getenv('DB_PORT') ?: '4777';
        $database = getenv('DB_NAME') ?: 'milkTrack';
        $usuario = getenv('DB_USER') ?: 'postgres';
        $senha = getenv('DB_PASS') ?: 'postgres';

        $dsn = "pgsql:host=$host;port=$porta;dbname=$database";

        $this->connection = new PDO($dsn, $usuario, $senha);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}