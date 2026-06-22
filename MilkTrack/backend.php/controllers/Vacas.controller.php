<?php

require_once __DIR__ . '/../dao/Vacas.dao.php'; // carrega o DAO (que já carrega Database e Model)

// Controller: orquestra a comunicação entre o DAO e as Views
class VacasController
{
    // Retorna todos os vacas buscados do banco
    public function listar()
    {
        $dao = new VacasDao();
        return $dao->listar();
    }

    // Ação de cadastro: lê o POST, salva no banco e redireciona
    public function salvar($dados = null)
    {
        if ($dados === null) {
            $dados = $_POST;
        }

        $vaca = new Vacas(
            $dados['nome'] ?? null,
            $dados['raca'] ?? null,
            $dados['data_nascimento'] ?? null
        );

        $dao = new VacasDao(); // instancia o DAO
        $dao->salvar($vaca);  // salva o objeto no banco

        return ['success' => true];
    }

    public function buscarPorId($id)
    {
        $dao = new VacasDao();
        return $dao->buscarPorId($id);
    }

    public function atualizar($id, $dados = null)
    {
        if ($dados === null) {
            $dados = $_POST;
        }

        $vaca = new Vacas(
            $dados['nome'] ?? null,
            $dados['raca'] ?? null,
            $dados['data_nascimento'] ?? null,
            $id
        );

        $dao = new VacasDao();
        $dao->editar($vaca);

        return ['success' => true];
    }

    public function deletar($id)
    {
        $dao = new VacasDao();
        $dao->deletar($id);
        return ['success' => true];
    }
}
