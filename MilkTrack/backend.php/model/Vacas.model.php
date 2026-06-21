<?php

class Vacas
{
    private $id;
    private $nome;
    private $raca;
    private $data_nascimento;

    public function __construct($nome, $raca, $data_nascimento, $id = null)
    {
        $this->nome = $nome;
        $this->raca = $raca;
        $this->data_nascimento = $data_nascimento;
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
    public function getRaca()
    {
        return $this->raca;
    }
    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }
}
