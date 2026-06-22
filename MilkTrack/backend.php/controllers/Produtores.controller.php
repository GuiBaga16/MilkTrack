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
    public function salvar()
    {
        // Cria o objeto com os dados enviados pelo formulário via POST
        $produtor = new Produtores(
            $_POST['nome'],     // nome do produtor
            $_POST['cidade'],    // cidade do produtor
            $_POST['telefone']        // telefone do produtor
        );

        $dao = new ProdutoresDao(); // instancia o DAO
        $dao->salvar($produtor);  // salva o objeto no banco

    }
}
