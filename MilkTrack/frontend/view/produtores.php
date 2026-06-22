<?php require_once __DIR__ . '/../../backend.php/controllers/Produtores.controller.php';
$controller = new ProdutoresController();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $controller->deletar((int) $_GET['id']);
    header('Location: produtores.php');
    exit;
}

$editing = null;
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $editing = $controller->buscarPorId((int) $_GET['id']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id'])) {
        $controller->atualizar((int) $_POST['id']);
    } else {
        $controller->salvar();
    }
    header('Location: produtores.php');
    exit;
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
        <li><a href="produtores.php">Produtor</a></li>
        <li style="margin-left: auto;"><a href="index.php">🏠 Início</a></li>
    </ul>

    <div class="container">
        <h1>Gerenciamento de Produtores</h1>

        <form method="POST" action="" class="form-container">
            <div class="form-group">
                <label for="nome">Nome da Vaca</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome" required
                    value="<?= $editing ? $editing->getNome() : '' ?>">
                <input type="hidden" name="id" value="<?= $editing ? $editing->getId() : '' ?>">
            </div>

            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" placeholder="Digite a cidade" required
                    value="<?= $editing ? $editing->getCidade() : '' ?>">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone" placeholder="(xx) xxxx-xxxx" required
                    value="<?= $editing ? $editing->getTelefone() : '' ?>">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary"><?= $editing ? 'Atualizar' : 'Salvar' ?></button>
                <?php if ($editing): ?>
                    <a href="vacas.php" class="btn-secondary">Cancelar</a>
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
                        <th>Nome</th>
                        <th>Raça</th>
                        <th>Data de Nascimento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtores as $p): ?>
                        <tr>
                            <td><?= $p->getId() ?></td>
                            <td><?= $p->getNome() ?></td>
                            <td><?= $p->getCidade() ?></td>
                            <td><?= $p->getTelefone() ?></td>
                            <td>
                                <a class="btn-primary" href="?action=edit&id=<?= $p->getId() ?>">Editar</a>
                                <a class="btn-danger" href="?action=delete&id=<?= $p->getId() ?>"
                                    onclick="return confirm('Confirma exclusão deste registro?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>