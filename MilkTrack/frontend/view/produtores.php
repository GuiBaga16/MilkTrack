<?php require_once __DIR__ . '/../../backend.php/controllers/Produtores.controller.php';
$controller = new ProdutoresController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->salvar();
}
$produtores = $controller->listar();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Gerenciamento de Produtores - MilkTrack</title>
</head>

<body>
    <ul class="menu">
        <img src="../styles/logo_MilkTrack.png" alt="Logo MilkTrack" class="logo">
        <li><a href="leites.php">Leite</a></li>
        <li><a href="vacas.php">Vaca</a></li>
        <li style="margin-left: auto;"><a href="index.php">🏠 Início</a></li>
    </ul>

    <div class="container">
        <h1>Gerenciamento de Produtores</h1>

        <form method="POST" action="" class="form-container">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome" required>
            </div>

            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" placeholder="Digite a cidade" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone" placeholder="(xx) xxxx-xxxx" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Salvar</button>
                <a href="index.php" class="btn-secondary">Voltar</a>
            </div>
        </form>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Cidade</th>
                        <th>Telefone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtores as $p): ?>
                        <tr>
                            <td>
                                <?= $p->getId() ?>
                            </td>
                            <td>
                                <?= $p->getNome() ?>
                            </td>
                            <td>
                                <?= $p->getCidade() ?>
                            </td>
                            <td>
                                <?= $p->getTelefone() ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>