<?php
use dao\mysql\DesafioDAO;

// Exemplo de conexão MySQLi (ajuste para seu ambiente)
$conn = new mysqli('localhost', 'usuario', 'senha', 'appfit');
if ($conn->connect_error) {
    die('Erro de conexão: ' . $conn->connect_error);
}

$desafioDAO = new DesafioDAO($conn);

// Se estiver editando, busca os dados
$desafio = null;
if (isset($_GET['id'])) {
    $desafio = $desafioDAO->listarId($_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $desafio ? 'Editar Desafio' : 'Novo Desafio' ?></title>
    <link rel="stylesheet" href="/public/styles.css">
</head>
<body>
    <h1><?= $desafio ? 'Editar Desafio' : 'Novo Desafio' ?></h1>
    <form method="post" action="salvar.php">
        <?php if ($desafio): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($desafio['id']) ?>">
        <?php endif; ?>
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" value="<?= $desafio ? htmlspecialchars($desafio['titulo']) : '' ?>" required><br><br>
        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" required><?= $desafio ? htmlspecialchars($desafio['descricao']) : '' ?></textarea><br><br>
        <label for="nivel">Nível:</label><br>
        <select id="nivel" name="nivel" required>
            <option value="Iniciante" <?= $desafio && $desafio['nivel']=='Iniciante' ? 'selected' : '' ?>>Iniciante</option>
            <option value="Intermediário" <?= $desafio && $desafio['nivel']=='Intermediário' ? 'selected' : '' ?>>Intermediário</option>
            <option value="Avançado" <?= $desafio && $desafio['nivel']=='Avançado' ? 'selected' : '' ?>>Avançado</option>
        </select><br><br>
        <button type="submit">Salvar</button>
        <a href="listar.php" class="btn">Cancelar</a>
    </form>
</body>
</html>
<?php $conn->close(); ?>
