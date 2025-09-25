<?php
use dao\mysql\DesafioDAO;

// Exemplo de conexão MySQLi (ajuste para seu ambiente)
$conn = new mysqli('localhost', 'usuario', 'senha', 'appfit');
if ($conn->connect_error) {
    die('Erro de conexão: ' . $conn->connect_error);
}

$desafioDAO = new DesafioDAO($conn);
$desafios = $desafioDAO->listarTodos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar Desafios</title>
    <link rel="stylesheet" href="/public/styles.css">
</head>
<body>
    <h1>Desafios</h1>
    <a href="formulario.php" class="btn">Novo Desafio</a>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Nível</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($desafios as $desafio): ?>
                <tr>
                    <td><?= htmlspecialchars($desafio['id']) ?></td>
                    <td><?= htmlspecialchars($desafio['titulo']) ?></td>
                    <td><?= htmlspecialchars($desafio['descricao']) ?></td>
                    <td><?= htmlspecialchars($desafio['nivel']) ?></td>
                    <td>
                        <a href="formulario.php?id=<?= $desafio['id'] ?>">Editar</a> |
                        <a href="listar.php?id=<?= $desafio['id'] ?>">Visualizar</a> |
                        <a href="excluir.php?id=<?= $desafio['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a> |
                        <form method="post" action="participar.php" style="display:inline">
                            <input type="hidden" name="idDesafio" value="<?= $desafio['id'] ?>">
                            <button type="submit">Participar</button>
                        </form> |
                        <form method="post" action="progresso.php" style="display:inline">
                            <input type="hidden" name="idDesafio" value="<?= $desafio['id'] ?>">
                            <input type="text" name="progresso" placeholder="Progresso" required>
                            <button type="submit">Registrar Progresso</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
<?php $conn->close(); ?>
