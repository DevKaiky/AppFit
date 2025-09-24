<h2>Login</h2>

<?php
if (isset($_GET['erro'])) {
    if ($_GET['erro'] == 1) {
        echo '<p style="color: red;">Por favor, preencha o e-mail e a senha.</p>';
    } elseif ($_GET['erro'] == 2) {
        echo '<p style="color: red;">E-mail ou senha inválidos.</p>';
    }
}
?>

<form method="POST" action="index.php?param=Auth/login">
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required>
    <br><br>
    <label for="senha">Senha:</label><br>
    <input type="password" id="senha" name="senha" required>
    <br><br>
    <input type="submit" value="Entrar">
</form>

<p>Não tem uma conta? <a href="index.php?param=Usuario/formulario">Cadastre-se aqui</a>.</p>