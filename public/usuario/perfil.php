<?php

$usuario = $parametro;
?>

<h2>Meu Perfil</h2>

<?php
if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) {
    echo '<p style="color: green;">O seu perfil foi atualizado com sucesso!</p>';
}
?>

<form method="POST" action="index.php?param=Usuario/salvar">
    <input type="hidden" name="id" value="<?= ($usuario) ? htmlspecialchars($usuario['id']) : '' ?>">

    <label for="nome">Nome:</label><br>
    <input type="text" id="nome" name="nome" value="<?= ($usuario) ? htmlspecialchars($usuario['nome']) : '' ?>" required>
    <br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?= ($usuario) ? htmlspecialchars($usuario['email']) : '' ?>" required>
    <br><br>

    <label for="senha">Nova Senha:</label><br>
    <input type="password" id="senha" name="senha">
    <small>(Deixe em branco para não alterar a senha)</small>
    <br><br>

    <input type="submit" value="Salvar Alterações">
</form>

