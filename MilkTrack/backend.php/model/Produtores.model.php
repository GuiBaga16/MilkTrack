<?php

class Produtores
{
    private $id;
    private $nome;
    private $cidade;
    private $telefone;
    private $cep;
    private $rua;
    private $bairro;
    private $uf;

    // Construtor compatível com DAO (nome, cidade, telefone, id)
    public function __construct($nome, $cidade = null, $telefone = null, $cep = null, $rua = null, $bairro = null, $uf = null, $id = null)
    {
        $this->nome = $nome;
        $this->cidade = $cidade;
        $this->telefone = $telefone;
        $this->cep = $cep;
        $this->rua = $rua;
        $this->bairro = $bairro;
        $this->uf = $uf;
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

    public function getCep()
    {
        return $this->cep;
    }

    public function getRua()
    {
        return $this->rua;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function getUf()
    {
        return $this->uf;
    }
}