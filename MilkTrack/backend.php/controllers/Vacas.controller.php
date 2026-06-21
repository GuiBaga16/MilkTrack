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
    public function salvar()
    {
        // Cria o objeto com os dados enviados pelo formulário via POST
        $vaca = new Vacas(
            $_POST['nome'],         // nome da vaca
            $_POST['raca'],           // raça da vaca
            $_POST['data_nascimento']  // data de nascimento da vaca
        );

        $dao = new VacasDao(); // instancia o DAO
        $dao->salvar($vaca);  // salva o objeto no banco

    }
}
