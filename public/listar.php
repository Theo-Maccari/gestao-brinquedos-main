<?php

require "../config/conexao.php";

try {

    $sql = "SELECT * FROM brinquedos ORDER BY id DESC";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    $brinquedos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $erro) {

    echo "Erro ao listar brinquedos: " . $erro->getMessage();
    exit;
}

?>

<h1>Gestão de Brinquedos</h1>

<a href="cadastrar.php">Cadastrar novo brinquedo</a>

<br><br>

<table border="1">

    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Faixa etária</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($brinquedos as $brinquedo): ?>

        <tr>

            <td><?= $brinquedo["id"] ?></td>

            <td><?= htmlspecialchars($brinquedo["nome"]) ?></td>

            <td><?= htmlspecialchars($brinquedo["categoria"]) ?></td>

            <td><?= htmlspecialchars($brinquedo["faixa_etaria"]) ?></td>

            <td>R$ <?= number_format($brinquedo["preco"], 2, ",", ".") ?></td>

            <td><?= $brinquedo["quantidade"] ?></td>

            <td>
                <a href="editar.php?id=<?= $brinquedo["id"] ?>">
                    Editar
                </a>

                |

                <a href="excluir.php?id=<?= $brinquedo["id"] ?>"
                   onclick="return confirm('Deseja excluir este brinquedo?')">
                    Excluir
                </a>
            </td>

        </tr>

    <?php endforeach; ?>

</table>