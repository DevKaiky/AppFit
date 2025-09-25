<a href="index.php?param=Desafio/formulario">Criar Novo Desafio</a>

<table border="1" width="100%" style="margin-top: 15px; border-collapse: collapse;">
    <tr style="background-color: #f2f2f2;">
        <th style="padding: 8px;">Título</th>
        <th style="padding: 8px;">Descrição</th>
        <th style="padding: 8px;">Nível</th>
        <th style="padding: 8px;">Participantes</th>
        <th style="padding: 8px;">Ações de Gestão</th>
    </tr>
<?php
if (!empty($parametro)) {
    foreach ($parametro as $desafio) {
    ?>
     <tr>
     <td style="padding: 8px;"><?= htmlspecialchars($desafio['titulo']) ?></td>
     <td style="padding: 8px;"><?= htmlspecialchars($desafio['descricao']) ?></td>
     <td style="padding: 8px;"><?= htmlspecialchars($desafio['nivel']) ?></td>
     <td style="padding: 8px; text-align: center;">
        <strong><?= htmlspecialchars($desafio['total_participantes']) ?></strong>
        
     </td>
     <td style="padding: 8px;">
        <a href='index.php?param=Desafio/formulario&id=<?= $desafio['id'] ?>'>Alterar</a>
        | <a href='index.php?param=Desafio/excluir&id=<?= $desafio['id'] ?>' onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
     </td>
     </tr>
    <?php
    }
} else {
    echo "<tr><td colspan='5' style='padding: 8px; text-align: center;'>Nenhum desafio encontrado.</td></tr>";
}
?>
</table>
