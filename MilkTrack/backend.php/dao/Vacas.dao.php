<?php

require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../model/Vacas.model.php';

class VacasDao
{
    private $tabela = 'vacas';
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->connection;
    }

    public function salvar(Vacas $vaca)
    {
        $sql = "INSERT INTO $this->tabela (nome, raca, data_nascimento) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($sql);

        $stmt->execute([$vaca->getNome(), $vaca->getRaca(), $vaca->getDataNascimento()]);
    }


    public function listar()
    {
        $sql = "SELECT * FROM $this->tabela";
        $stmt = $this->connection->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $vacas = [];

        foreach ($rows as $row) {

            $vacas[] = new Vacas(
                $row['nome'],
                $row['raca'],
                $row['data_nascimento'],
                $row['id']
            );
        }

        return $vacas;
    }
}
