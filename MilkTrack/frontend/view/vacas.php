<?php require_once __DIR__ . '/../controllers/Vacas.controller.php';
$controller = new VacasController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->salvar();
}
$vacas = $controller->listar();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Gerenciamento de Vacas - MilkTrack</title>
</head>

<body>
    <ul class="menu">
        <img src="../styles/logo_MilkTrack.png" alt="Logo MilkTrack" class="logo">
        <li><a href="leites.php">Leite</a></li>
        <li><a href="vacas.php">Vaca</a></li>
        <li style="margin-left: auto;"><a href="index.php">🏠 Início</a></li>
    </ul>

    <div class="container">
        <h1>Gerenciamento de Vacas</h1>

        <form method="POST" action="" class="form-container">
            <div class="form-group">
                <label for="nome">Nome da Vaca</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome" required>
            </div>

            <div class="form-group">
                <label for="raca">Raça</label>
                <input type="text" id="raca" name="raca" placeholder="Ex: Holandesa, Jersey" required>
            </div>

            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" id="data_nascimento" name="data_nascimento" required>
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
                        <th>Raça</th>
                        <th>Data de Nascimento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vacas as $vaca): ?>
                        <tr>
                            <td><?= $vaca->getId() ?></td>
                            <td><?= $vaca->getNome() ?></td>
                            <td><?= $vaca->getRaca() ?></td>
                            <td><?= $vaca->getDataNascimento() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>