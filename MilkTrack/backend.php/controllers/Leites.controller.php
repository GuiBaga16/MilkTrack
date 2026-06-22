<?php
require_once __DIR__ . '/../dao/Leites.dao.php'; // carrega o DAO (que já carrega Database e Model)

// Controller: orquestra a comunicação entre o DAO e as Views
class LeitesController
{
    // Retorna todos os leites buscados do banco
    public function listar()
    {
        $dao = new LeitesDao();
        return $dao->listar();
    }

    // Ação de cadastro: lê o POST, salva no banco e redireciona
    public function salvar($dados = null)
    {
        // Suporta chamada via form ($_POST) ou via API ($dados)
        if ($dados === null) {
            $dados = $_POST;
        }

        $leite = new Leites(
            $dados['quantidade'] ?? null,
            $dados['data_coleta'] ?? null,
            $dados['qualidade'] ?? null
        );

        $dao = new LeitesDao(); // instancia o DAO
        $dao->salvar($leite);  // salva o objeto no banco

        return ['success' => true];
    }

    public function buscarPorId($id)
    {
        $dao = new LeitesDao();
        return $dao->buscarPorId($id);
    }

    public function atualizar($id, $dados = null)
    {
        if ($dados === null) {
            $dados = $_POST;
        }

        $leite = new Leites(
            $dados['quantidade'] ?? null,
            $dados['data_coleta'] ?? null,
            $dados['qualidade'] ?? null,
            $id
        );

        $dao = new LeitesDao();
        $dao->editar($leite);

        return ['success' => true];
    }

    public function deletar($id)
    {
        $dao = new LeitesDao();
        $dao->deletar($id);
        return ['success' => true];
    }
}
