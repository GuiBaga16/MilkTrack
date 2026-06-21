<?php

class Produtores
{
    private $id;
    private $nome;
    private $cidade;
    private $telefone;

    public function __construct($nome, $cidade, $telefone, $id = null)
    {
        $this->nome = $nome;
        $this->cidade = $cidade;
        $this->telefone = $telefone;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getCidade()
    {
        return $this->cidade;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }

}