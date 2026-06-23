<?php

require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../model/Produtores.model.php';

class ProdutoresDao
{
    private $tabela = 'produtores';
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->connection;
    }

    public function salvar(Produtores $produtor)
    {
        $sql = "INSERT INTO $this->tabela (nome, cidade, telefone, cep, rua, bairro, uf) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            $produtor->getNome(),
            $produtor->getCidade(),
            $produtor->getTelefone(),
            $produtor->getCep(),
            $produtor->getRua(),
            $produtor->getBairro(),
            $produtor->getUf()
        ]);
    }


    public function listar()
    {
        $sql = "SELECT * FROM $this->tabela";
        $stmt = $this->connection->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $produtores = [];

        foreach ($rows as $row) {

            $produtores[] = new Produtores(
                $row['nome'],
                $row['cidade'],
                $row['telefone'],
                $row['cep'],
                $row['rua'],
                $row['bairro'],
                $row['uf'],
                $row['id']
            );
        }

        return $produtores;
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM $this->tabela WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row)
            return null;

        return new Produtores(
            $row['nome'],
            $row['cidade'],
            $row['telefone'],
            $row['cep'],
            $row['rua'],
            $row['bairro'],
            $row['uf'],
            $row['id']
        );
    }

    public function editar(Produtores $produtor)
    {
        $sql = "UPDATE $this->tabela SET nome = ?, cidade = ?, telefone = ?, cep = ?, rua = ?, bairro = ?, uf = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            $produtor->getNome(),
            $produtor->getCidade(),
            $produtor->getTelefone(),
            $produtor->getCep(),
            $produtor->getRua(),
            $produtor->getBairro(),
            $produtor->getUf(),
            $produtor->getId()
        ]);
    }

    public function deletar($id)
    {
        $sql = "DELETE FROM $this->tabela WHERE id = ?";
        $stmt = $this->connection->prepare($sql);

        $stmt->execute([$id]);
    }
}