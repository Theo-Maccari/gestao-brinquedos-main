<?php

require "../config/conexao.php";

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

        $sql = "INSERT INTO brinquedos 
                (nome, categoria, faixa_etaria, preco, quantidade)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conexao->prepare($sql);

        $stmt->execute([
            $nome,
            $categoria,
            $faixa_etaria,
            $preco,
            $quantidade
        ]);

        header("Location: listar.php");
        exit;
    }
}

?>

<h1>Cadastrar Brinquedo</h1>

<form method="POST">

    Nome:
    <input type="text" name="nome" required>
    <br><br>

    Categoria:
    <input type="text" name="categoria" required>
    <br><br>

    Faixa etária:
    <input type="text" name="faixa_etaria" required>
    <br><br>

    Preço:
    <input type="number" name="preco" step="0.01" min="0" required>
    <br><br>

    Quantidade:
    <input type="number" name="quantidade" min="0" required>
    <br><br>

    <button type="submit">Cadastrar</button>

</form>

<a href="listar.php">Voltar</a>