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
    public function salvar()
    {
        // Cria o objeto com os dados enviados pelo formulário via POST
        $leite = new Leites(
            $_POST['quantidade'],     // quantidade de leite
            $_POST['data_coleta'],    // data de coleta
            $_POST['qualidade']        // qualidade do leite
        );

        $dao = new LeitesDao(); // instancia o DAO
        $dao->salvar($leite);  // salva o objeto no banco

    }
}
