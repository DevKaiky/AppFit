<table border="1" width="100%" style="margin-top: 15px; border-collapse: collapse;">
    <tr style="background-color: #f2f2f2;">
        <th style="padding: 8px;">ID</th>
        <th style="padding: 8px;">Nome</th>
        <th style="padding: 8px;">Email</th>
        <th style="padding: 8px;">Tipo</th>
        <th style="padding: 8px;">Ações</th>
    </tr>
<?php
if (!empty($parametro)) {
    foreach ($parametro as $usuario) {
    ?>
     <tr>
     <td style="padding: 8px;"><?= htmlspecialchars($usuario['id']) ?></td>
     <td style="padding: 8px;"><?= htmlspecialchars($usuario['nome']) ?></td>
     <td style="padding: 8px;"><?= htmlspecialchars($usuario['email']) ?></td>
     <td style="padding: 8px;"><?= htmlspecialchars($usuario['tipo']) ?></td>

     <td style="padding: 8px;">
        <a href='index.php?param=Admin/Usuario/formulario&id=<?= $usuario['id'] ?>'>Alterar</a>
        | <a href='index.php?param=Admin/Usuario/excluir&id=<?= $usuario['id'] ?>' onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
     </td>
     </tr>
    <?php
    }
} else {
    echo "<tr><td colspan='5' style='padding: 8px; text-align: center;'>Nenhum usuário encontrado.</td></tr>";
}
?>
</table>
