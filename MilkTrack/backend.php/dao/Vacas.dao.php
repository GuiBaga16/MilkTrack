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

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM $this->tabela WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row)
            return null;

        return new Vacas(
            $row['nome'],
            $row['raca'],
            $row['data_nascimento'],
            $row['id']
        );
    }

    public function editar(Vacas $vaca)
    {
        $sql = "UPDATE $this->tabela SET nome = ?, raca = ?, data_nascimento = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            $vaca->getNome(),
            $vaca->getRaca(),
            $vaca->getDataNascimento(),
            $vaca->getId()
        ]);
    }

    public function deletar($id)
    {
        $sql = "DELETE FROM $this->tabela WHERE id = ?";
        $stmt = $this->connection->prepare($sql);

        $stmt->execute([$id]);
    }
}
