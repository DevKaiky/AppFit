<?php if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin'): ?>
    <a href="index.php?param=Desafio/formulario">Criar Novo Desafio</a>
<?php endif; ?>

<table border="1" width="100%" style="margin-top: 15px; border-collapse: collapse;">
    <tr style="background-color: #f2f2f2;">
        <th style="padding: 8px;">Título</th>
        <th style="padding: 8px;">Descrição</th>
        <th style="padding: 8px;">Nível</th>
        <th style="padding: 8px;">Ações</th>
    </tr>
<?php
if (!empty($parametro)) {
    foreach ($parametro as $desafio) {
    ?>
     <tr>
     <td style="padding: 8px;"><?= htmlspecialchars($desafio['titulo']) ?></td>
     <td style="padding: 8px;"><?= htmlspecialchars($desafio['descricao']) ?></td>
     <td style="padding: 8px;"><?= htmlspecialchars($desafio['nivel']) ?></td>
     <td style="padding: 8px;">
        <?php
        if ($desafio['participante'] == 1):
        ?>
            
            <a href="index.php?param=Desafio/detalhes&id=<?= $desafio['id'] ?>" style="color: green; font-weight: bold;">Ver Progresso</a>
        <a href='index.php?param=Desafio/cancelarParticipacao&id=<?= $desafio['id'] ?>' onclick="return confirm('Todo seu progresso nesse desafio sera perdido, tem certeza que deseja cancelar a participação neste desafio?')" style="color: red;">Cancelar</a>
        <?php else: ?>
            <a href='index.php?param=Desafio/participar&id=<?= $desafio['id'] ?>'>Participar</a>
        <?php endif; ?>

        <?php if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin'): ?>
            | <a href='index.php?param=Desafio/formulario&id=<?= $desafio['id'] ?>'>Alterar</a>
            | <a href='index.php?param=Desafio/excluir&id=<?= $desafio['id'] ?>' onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
        <?php endif; ?>
     </td>
     </tr>
    <?php
    }
} else {
    echo "<tr><td colspan='4' style='padding: 8px; text-align: center;'>Nenhum desafio encontrado. Crie um no painel de administração.</td></tr>";
}
?>
</table>

