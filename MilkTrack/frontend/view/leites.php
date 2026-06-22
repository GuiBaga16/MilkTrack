<?php require_once __DIR__ . '/../../backend.php/controllers/Leites.controller.php';
$controller = new LeitesController();

// Deletar via GET (confirmação feita no link)
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $controller->deletar((int) $_GET['id']);
    header('Location: leites.php');
    exit;
}

// Preparar edição
$editing = null;
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $editing = $controller->buscarPorId((int) $_GET['id']);
}

// Salvar ou atualizar via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id'])) {
        $controller->atualizar((int) $_POST['id']);
    } else {
        $controller->salvar();
    }
    header('Location: leites.php');
    exit;
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
        <li><a href="produtores.php">Produtor</a></li>
        <li style="margin-left: auto;"><a href="index.php">🏠 Início</a></li>
    </ul>

    <div class="container">
        <h1>Gerenciamento de Leite</h1>

        <form method="POST" action="" class="form-container">
            <div class="form-group">
                <label for="quantidade">Quantidade (em litros)</label>
                <input type="text" id="quantidade" name="quantidade" placeholder="Ex: 50.5" required
                    value="<?= $editing ? $editing->getQuantidade() : '' ?>">
                <input type="hidden" name="id" value="<?= $editing ? $editing->getId() : '' ?>">
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
                <button type="submit" class="btn-primary"><?= $editing ? 'Atualizar' : 'Salvar' ?></button>
                <?php if ($editing): ?>
                    <a href="leites.php" class="btn-secondary">Cancelar</a>
                <?php else: ?>
                    <a href="index.php" class="btn-secondary">Voltar</a>
                <?php endif; ?>
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
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leite as $item): ?>
                        <tr>
                            <td><?= $item->getId() ?></td>
                            <td><?= $item->getQuantidade() ?> L</td>
                            <td><?= $item->getDataColeta() ?></td>
                            <td><?= $item->getQualidade() ?></td>
                            <td>
                                <a class="btn-primary" href="?action=edit&id=<?= $item->getId() ?>">Editar</a>
                                <a class="btn-danger" href="?action=delete&id=<?= $item->getId() ?>"
                                    onclick="return confirm('Confirma exclusão deste registro?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>