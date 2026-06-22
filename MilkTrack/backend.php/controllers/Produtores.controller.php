<?php

require_once __DIR__ . '/../dao/Produtores.dao.php'; // carrega o DAO (que já carrega Database e Model)

// Controller: orquestra a comunicação entre o DAO e as Views
class ProdutoresController
{
    // Retorna todos os produtores buscados do banco
    public function listar()
    {
        $dao = new ProdutoresDao();
        return $dao->listar();
    }

    // Ação de cadastro: lê o POST, salva no banco e redireciona
    public function salvar($dados = null)
    {
        if ($dados === null) {
            $dados = $_POST;
        }

        $produtor = new Produtores(
            $dados['nome'] ?? null,
            $dados['cidade'] ?? null,
            $dados['telefone'] ?? null
        );

        $dao = new ProdutoresDao(); // instancia o DAO
        $dao->salvar($produtor);  // salva o objeto no banco

        return ['success' => true];
    }

    public function buscarPorId($id)
    {
        $dao = new ProdutoresDao();
        return $dao->buscarPorId($id);
    }

    public function atualizar($id, $dados = null)
    {
        if ($dados === null) {
            $dados = $_POST;
        }

        $produtor = new Produtores(
            $dados['nome'] ?? null,
            $dados['cidade'] ?? null,
            $dados['telefone'] ?? null,
            $id
        );

        $dao = new ProdutoresDao();
        $dao->editar($produtor);

        return ['success' => true];
    }

    public function deletar($id)
    {
        $dao = new ProdutoresDao();
        $dao->deletar($id);
        return ['success' => true];
    }
}
