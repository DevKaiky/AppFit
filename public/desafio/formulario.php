<?php
$desafio = ($parametro != null) ? $parametro : null;
?>

<h2><?= ($desafio) ? 'Editar Desafio' : 'Novo Desafio' ?></h2>
<form method="POST" action="index.php?param=Desafio/salvar">
    <input type="hidden" name="id" value="<?= ($desafio) ? htmlspecialchars($desafio['id']) : '' ?>">

    <label for="titulo">Título:</label><br>
    <input type="text" id="titulo" name="titulo" value="<?= ($desafio) ? htmlspecialchars($desafio['titulo']) : '' ?>" required>
    <br><br>

    <label for="descricao">Descrição:</label><br>
    <textarea id="descricao" name="descricao" required><?= ($desafio) ? htmlspecialchars($desafio['descricao']) : '' ?></textarea>
    <br><br>

    <label for="nivel">Nível:</label><br>
    <select id="nivel" name="nivel" required>
        <option value="Iniciante" <?= ($desafio && $desafio['nivel'] == 'Iniciante') ? 'selected' : '' ?>>Iniciante</option>
        <option value="Intermediário" <?= ($desafio && $desafio['nivel'] == 'Intermediário') ? 'selected' : '' ?>>Intermediário</option>
        <option value="Avançado" <?= ($desafio && $desafio['nivel'] == 'Avançado') ? 'selected' : '' ?>>Avançado</option>
    </select>
    <br><br>

    <input type="submit" value="Salvar">
</form>
