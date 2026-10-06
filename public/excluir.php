<?php

require "../config/conexao.php";

if (!isset($_GET["id"])) {
    die("Brinquedo não encontrado.");
}

$id = $_GET["id"];

try {

    $sql = "DELETE FROM brinquedos WHERE id = ?";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([$id]);

    header("Location: listar.php");
    exit;

} catch (PDOException $erro) {

    echo "Erro ao excluir brinquedo: " . $erro->getMessage();
}

?>