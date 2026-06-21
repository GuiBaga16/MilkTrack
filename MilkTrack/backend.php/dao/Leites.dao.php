<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../model/Leites.model.php';

class LeitesDao
{
    private $tabela = 'leites';
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->connection;
    }

    public function salvar(Leites $leite)
    {
        $sql = "INSERT INTO $this->tabela (quantidade, data_coleta, qualidade) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($sql);

        $stmt->execute([$leite->getQuantidade(), $leite->getDataColeta(), $leite->getQualidade()]);
    }


    public function listar()
    {
        $sql = "SELECT * FROM $this->tabela";
        $stmt = $this->connection->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $leites = [];

        foreach ($rows as $row) {

            $leites[] = new Leites(
                $row['quantidade'],
                $row['data_coleta'],
                $row['qualidade'],
                $row['id']
            );
        }

        return $leites;
    }
}