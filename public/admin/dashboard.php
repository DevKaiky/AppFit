    <h2>Painel de Administração</h2>
    <p>Bem-vindo à área administrativa, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>.</p>
    <p>A partir daqui, você pode gerir o conteúdo do site.</p>
    
    <ul>
        <li><a href="index.php?param=Admin/Usuario/listar">Gerir Utilizadores</a></li>
        <li><a href="index.php?param=Desafio/listar">Gerir Desafios</a> (a mesma página do utilizador)</li>
    </ul>
    
