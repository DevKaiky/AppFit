<?php

$desafio = $parametro['desafio'] ?? null;
$progressos = $parametro['progressos'] ?? [];

if (!$desafio) {
    echo "<h2>Desafio não encontrado!</h2>";
    return;
}
?>

<h2>Detalhes do Desafio: <?= htmlspecialchars($desafio['titulo']) ?></h2>
<p><strong>Nível:</strong> <?= htmlspecialchars($desafio['nivel']) ?></p>
<p><strong>Descrição:</strong> <?= htmlspecialchars($desafio['descricao']) ?></p>

<hr>

<h3>Registar Novo Progresso</h3>
<form method="POST" action="index.php?param=Desafio/registrarProgresso">
    <input type="hidden" name="desafio_id" value="<?= $desafio['id'] ?>">
    <label for="observacao">Observação:</label><br>
    <textarea id="observacao" name="observacao" rows="4" cols="50" required placeholder="Ex: Corri 5km em 30 minutos hoje."></textarea>
    <br><br>
    <input type="submit" value="Registar Progresso">
</form>

<hr>

<h3>Meu Histórico de Progresso</h3>
<?php if (!empty($progressos)): ?>
    <table border="1" width="100%" style="margin-top: 15px; border-collapse: collapse;">
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 8px;">Data</th>
            <th style="padding: 8px;">Observação</th>
            <th style="padding: 8px;">Ações</th>
        </tr>
        <?php foreach ($progressos as $progresso): ?>
            <tr>
                <td style="padding: 8px; width: 25%;"><?= htmlspecialchars(date('d/m/Y H:i:s', strtotime($progresso['data_registo']))) ?></td>
                <td style="padding: 8px;"><?= htmlspecialchars($progresso['observacao']) ?></td>
                <!-- BOTÕES DE AÇÃO DO PROGRESSO -->
                <td style="padding: 8px; width: 15%;">
                    <a href="index.php?param=Desafio/formularioProgresso&id=<?= $progresso['id'] ?>&desafioId=<?= $desafio['id'] ?>&obs=<?= urlencode($progresso['observacao']) ?>">Alterar</a>
                    | <a href="index.php?param=Desafio/excluirProgresso&id=<?= $progresso['id'] ?>&desafioId=<?= $desafio['id'] ?>" onclick="return confirm('Tem a certeza que deseja excluir este registo?')" style="color: red;">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Você ainda não registou nenhum progresso para este desafio.</p>
<?php endif; ?>
