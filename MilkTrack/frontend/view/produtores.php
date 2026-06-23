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
    <title>Cadastro de Produtores - MilkTrack</title>
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
        <h1>Cadastro de Produtores</h1>

        <form method="POST" action="" class="form-container">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome" required
                    value="<?= $editing ? $editing->getNome() : '' ?>">
                <input type="hidden" name="id" value="<?= $editing ? $editing->getId() : '' ?>">
            </div>

            <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" id="cep" name="cep" maxlength="9" placeholder="00000-000" required
                    value="<?= $editing ? $editing->getCep() : '' ?>">
            </div>

            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" placeholder="Cidade" required readonly
                    value="<?= $editing ? $editing->getCidade() : '' ?>">
            </div>

            <div class="form-group">
                <label for="uf">UF</label>
                <input type="text" id="uf" name="uf" placeholder="Sigla do estado" required readonly
                    value="<?= $editing ? $editing->getUf() : '' ?>">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone" placeholder="(xx) xxxx-xxxx" required
                    value="<?= $editing ? $editing->getTelefone() : '' ?>">
            </div>

            <div class="form-group">
                <label for="rua">Rua</label>
                <input type="text" id="rua" name="rua" placeholder="Digite a rua" required
                    value="<?= $editing ? $editing->getRua() : '' ?>">
            </div>

            <div class="form-group">
                <label for="bairro">Bairro</label>
                <input type="text" id="bairro" name="bairro" placeholder="Digite o bairro" required
                    value="<?= $editing ? $editing->getBairro() : '' ?>">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary"><?= $editing ? 'Atualizar' : 'Salvar' ?></button>
                <?php if ($editing): ?>
                    <a href="produtores.php" class="btn-secondary">Cancelar</a>
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
                        <th>cidade</th>
                        <th>Telefone</th>
                        <th>CEP</th>
                        <th>Rua</th>
                        <th>Bairro</th>
                        <th>UF</th>
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
                            <td><?= $p->getCep() ?></td>
                            <td><?= $p->getRua() ?></td>
                            <td><?= $p->getBairro() ?></td>
                            <td><?= $p->getUf() ?></td>
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

    <!-- JavaScript para buscar endereço pelo CEP -->

    <script>
        const cepInput = document.getElementById('cep');

        cepInput.addEventListener('blur', async () => {

            const cep = cepInput.value.replace(/\D/g, '');

            if (cep.length !== 8) {
                alert('CEP inválido!');
                return;
            }

            try {

                const resposta = await fetch(
                    `https://viacep.com.br/ws/${cep}/json/`
                );

                const dados = await resposta.json();

                if (dados.erro) {
                    alert('CEP não encontrado!');
                    return;
                }

                document.getElementById('rua').value = dados.logradouro || '';
                document.getElementById('bairro').value = dados.bairro || '';
                document.getElementById('cidade').value = dados.localidade || '';
                document.getElementById('uf').value = dados.uf || '';

            } catch (erro) {

                console.error(erro);
                alert('Erro ao consultar o CEP.');

            }

        });

        document.getElementById('cep').addEventListener('input', function (e) {

            let valor = e.target.value.replace(/\D/g, '');

            if (valor.length > 5) {
                valor = valor.substring(0, 5) + '-' + valor.substring(5, 8);
            }

            e.target.value = valor;
        });

    </script>

</body>