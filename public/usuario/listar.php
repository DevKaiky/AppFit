<a href="index.php?param=Usuario/formulario">Cadastrar Novo Usuário</a>

<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Data de Criação</th>
        <th>Ações</th>
    </tr>
<?php
// A variável $parametro é passada pelo método layout() do template
if (!empty($parametro)) {
    foreach ($parametro as $usuario) {
    ?>
     <tr>
     <td><?= htmlspecialchars($usuario['id']) ?></td>
     <td><?= htmlspecialchars($usuario['nome']) ?></td>
     <td><?= htmlspecialchars($usuario['email']) ?></td>
     <td><?= htmlspecialchars(date('d/m/Y H:i:s', strtotime($usuario['data_criacao']))) ?></td>
     <td>
        <a href='index.php?param=Usuario/formulario&id=<?= $usuario['id'] ?>'>Alterar</a>
        <a href='index.php?param=Usuario/excluir&id=<?= $usuario['id'] ?>' onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
     </td>
     </tr>
    <?php
    }
} else {
    echo "<tr><td colspan='5'>Nenhum usuário encontrado.</td></tr>";
}
?>
</table>