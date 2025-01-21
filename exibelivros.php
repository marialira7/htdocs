<?php
require 'php/conexao.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['id'];
$stmt = $pdo->prepare("SELECT * FROM livro WHERE user_id = :id"); // é necessário ordenar os livros, pela data de criação
$stmt->execute([':id' => $usuario_id]);
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
    <h1>Seus Livros</h1>
    <a href="cadastrarlivros.php">Cadastrar Novo Livro</a>
    <ul>
        <?php foreach ($livros as $livro): ?>
            <li>
                <img src="<?= htmlspecialchars($livro['capa']) ?>" alt="Capa" style="width: 100px;">
                <strong><?= htmlspecialchars($livro['titulo']) ?></strong> - <?= htmlspecialchars($livro['autor']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>