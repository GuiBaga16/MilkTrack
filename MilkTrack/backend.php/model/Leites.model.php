<?php

class Leites
{
    private $id;
    private $quantidade;
    private $data_coleta;
    private $qualidade;

    public function __construct($quantidade, $data_coleta, $qualidade, $id = null)
    {
        $this->quantidade = $quantidade;
        $this->data_coleta = $data_coleta;
        $this->qualidade = $qualidade;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getQuantidade()
    {
        return $this->quantidade;
    }
    public function getDataColeta()
    {
        return $this->data_coleta;
    }
    public function getQualidade()
    {
        return $this->qualidade;
    }
}