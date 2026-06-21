<?php require_once __DIR__ . '/../controllers/Leites.controller.php';
$controller = new LeitesController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->salvar();
}
$leite = $controller->listar();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Gerenciamento de Leite - MilkTrack</title>
</head>

<body>
    <ul class="menu">
        <img src="../styles/logo_MilkTrack.png" alt="Logo MilkTrack" class="logo">
        <li><a href="leites.php">Leite</a></li>
        <li><a href="vacas.php">Vaca</a></li>
        <li style="margin-left: auto;"><a href="index.php">🏠 Início</a></li>
    </ul>

    <div class="container">
        <h1>Gerenciamento de Leite</h1>

        <form method="POST" action="" class="form-container">
            <div class="form-group">
                <label for="quantidade">Quantidade (em litros)</label>
                <input type="text" id="quantidade" name="quantidade" placeholder="Ex: 50.5" required>
            </div>

            <div class="form-group">
                <label for="data_coleta">Data de Coleta</label>
                <input type="date" id="data_coleta" name="data_coleta" required>
            </div>

            <div class="form-group">
                <label for="qualidade">Qualidade</label>
                <input type="text" id="qualidade" name="qualidade" placeholder="Ex: Excelente, Boa, Regular" required>
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
                        <th>Quantidade</th>
                        <th>Data de Coleta</th>
                        <th>Qualidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leite as $item): ?>
                        <tr>
                            <td><?= $item->getId() ?></td>
                            <td><?= $item->getQuantidade() ?> L</td>
                            <td><?= $item->getDataColeta() ?></td>
                            <td><?= $item->getQualidade() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>