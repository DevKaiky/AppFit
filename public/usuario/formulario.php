<?php
// Se $parametro (dados do usuário) existir, estamos em modo de edição
$usuario = ($parametro != null) ? $parametro[0] : null;
$actionUrl = "index.php?param=Usuario/salvar";
?>

<h2>Formulário de Usuário</h2>
<form method="POST" action="<?= $actionUrl ?>">
    <input type="hidden" name="id" value="<?= ($usuario) ? htmlspecialchars($usuario['id']) : '' ?>">

    <label for="nome">Nome:</label><br>
    <input type="text" id="nome" name="nome" value="<?= ($usuario) ? htmlspecialchars($usuario['nome']) : '' ?>" required>
    <br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?= ($usuario) ? htmlspecialchars($usuario['email']) : '' ?>" required>
    <br><br>

    <label for="senha">Senha:</label><br>
    <input type="password" id="senha" name="senha" <?= ($usuario) ? '' : 'required' ?>>
    <?php if ($usuario): ?>
        <small>(Deixe em branco para não alterar)</small>
    <?php endif; ?>
    <br><br>

    <input type="submit" value="Salvar">
</form>