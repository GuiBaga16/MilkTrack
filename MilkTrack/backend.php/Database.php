<?php

require_once __DIR__ . '/Env.php';
class Database
{
    public $connection; // conexão PDO acessada pelo DAO

    public function __construct()
    {
        $host = Env::get('DB_HOST', 'localhost');
        $porta = Env::get('DB_PORT', '4777');
        $database = Env::get('DB_NAME', 'milkTrack');
        $usuario = Env::get('DB_USER', 'postgres');
        $senha = Env::get('DB_PASS', 'postgres');

        $dsn = "pgsql:host=$host;port=$porta;dbname=$database";

        $this->connection = new PDO($dsn, $usuario, $senha);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}