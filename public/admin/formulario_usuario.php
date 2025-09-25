<?php
$usuario = $parametro;
?>

<h2>Editar Utilizador (Admin)</h2>
<form method="POST" action="index.php?param=Admin/Usuario/salvar">
    <input type="hidden" name="id" value="<?= ($usuario) ? htmlspecialchars($usuario['id']) : '' ?>">

    <label for="nome">Nome:</label><br>
    <input type="text" id="nome" name="nome" value="<?= ($usuario) ? htmlspecialchars($usuario['nome']) : '' ?>" required>
    <br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?= ($usuario) ? htmlspecialchars($usuario['email']) : '' ?>" required>
    <br><br>

    <label for="tipo">Tipo de Utilizador:</label><br>
    <select id="tipo" name="tipo">
        <option value="user" <?= ($usuario && $usuario['tipo'] == 'user') ? 'selected' : '' ?>>User</option>
        <option value="admin" <?= ($usuario && $usuario['tipo'] == 'admin') ? 'selected' : '' ?>>Admin</option>
    </select>
    <br><br>

    <label for="senha">Nova Senha:</label><br>
    <input type="password" id="senha" name="senha">
    <small>(Deixe em branco para não alterar)</small>
    <br><br>

    <input type="submit" value="Salvar Alterações">
</form>
