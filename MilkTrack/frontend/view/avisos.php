<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Avisos - MilkTrack</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>

    <ul class="menu">
        <img src="../styles/logo_MilkTrack.png" alt="Logo MilkTrack" class="logo">
        <li><a href="leites.php">Leite</a></li>
        <li><a href="vacas.php">Vaca</a></li>
        <li><a href="produtores.php">Produtor</a></li>
        <li><a href="avisos.php">Avisos</a></li>
        <li style="margin-left:auto"><a href="index.php">🏠 Início</a></li>
    </ul>

    <div class="container">

        <h1>Cadastro de Avisos</h1>

        <form id="formAviso">

            <input type="hidden" id="editandoId">

            <div class="form-group">
                <label>Título</label>
                <input type="text" id="titulo" required>
            </div>

            <div class="form-group">
                <label>Mensagem</label>
                <textarea id="mensagem" rows="4" required></textarea>
            </div>

        </form>

        <br>

        <table class="data-table">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Mensagem</th>
                </tr>

            </thead>

            <tbody id="lista"></tbody>

        </table>

    </div>

</body>

<script>

    const API = "https://6a4270957602860e652173b0.mockapi.io/Avisos";

    async function carregar() {

        const resposta = await fetch(API);

        const avisos = await resposta.json();

        let html = "";

        for (const aviso of avisos) {

            html += `
            <tr>

                <td>${aviso.id}</td>
                <td>${aviso.titulo}</td>
                <td>${aviso.mensagem}</td>

            </tr>
        `;
        }

        document.getElementById("lista").innerHTML = html;
    }

    // Faz o formulário chamar a função salvar
    document.getElementById("formAviso").addEventListener("submit", salvar);

    async function salvar(event) {

        event.preventDefault();

        const dados = {

            titulo: document.getElementById("titulo").value,
            mensagem: document.getElementById("mensagem").value

        };

        await fetch(API, {

            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify(dados)

        });

        document.getElementById("formAviso").reset();

        carregar();

    }

    carregar();

</script>

</html>