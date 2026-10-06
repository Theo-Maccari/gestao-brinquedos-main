<?php

require "../config/conexao.php";

if (!isset($_GET["id"])) {
    die("Brinquedo não encontrado.");
}

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $categoria = trim($_POST["categoria"]);
    $faixa_etaria = trim($_POST["faixa_etaria"]);
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];

    if (
        empty($nome) ||
        empty($categoria) ||
        empty($faixa_etaria) ||
        $preco < 0 ||
        $quantidade < 0
    ) {

        echo "Preencha os dados corretamente.";

    } else {

        $sql = "UPDATE brinquedos
                SET nome = ?,
                    categoria = ?,
                    faixa_etaria = ?,
                    preco = ?,
                    quantidade = ?
                WHERE id = ?";

        $stmt = $conexao->prepare($sql);

        $stmt->execute([
            $nome,
            $categoria,
            $faixa_etaria,
            $preco,
            $quantidade,
            $id
        ]);

        header("Location: listar.php");
        exit;
    }
}

$sql = "SELECT * FROM brinquedos WHERE id = ?";

$stmt = $conexao->prepare($sql);
$stmt->execute([$id]);

$brinquedo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$brinquedo) {
    die("Brinquedo não encontrado.");
}

?>

<h1>Editar Brinquedo</h1>

<form method="POST">

    Nome:
    <input type="text"
           name="nome"
           value="<?= htmlspecialchars($brinquedo["nome"]) ?>"
           required>
    <br><br>

    Categoria:
    <input type="text"
           name="categoria"
           value="<?= htmlspecialchars($brinquedo["categoria"]) ?>"
           required>
    <br><br>

    Faixa etária:
    <input type="text"
           name="faixa_etaria"
           value="<?= htmlspecialchars($brinquedo["faixa_etaria"]) ?>"
           required>
    <br><br>

    Preço:
    <input type="number"
           name="preco"
           step="0.01"
           min="0"
           value="<?= $brinquedo["preco"] ?>"
           required>
    <br><br>

    Quantidade:
    <input type="number"
           name="quantidade"
           min="0"
           value="<?= $brinquedo["quantidade"] ?>"
           required>
    <br><br>

    <button type="submit">Salvar alterações</button>

</form>

<a href="listar.php">Voltar</a>