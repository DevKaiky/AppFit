<h2>Editar Registo de Progresso</h2>

<form method="POST" action="index.php?param=Desafio/atualizarProgresso">
    <input type="hidden" name="progresso_id" value="<?= htmlspecialchars($parametro['progresso_id']) ?>">
    <input type="hidden" name="desafio_id" value="<?= htmlspecialchars($parametro['desafio_id']) ?>">
    
    <label for="observacao">Observação:</label><br>
    <textarea id="observacao" name="observacao" rows="4" cols="50" required><?= htmlspecialchars($parametro['observacao']) ?></textarea>
    <br><br>
    
    <input type="submit" value="Salvar Alteração">
    <a href="index.php?param=Desafio/detalhes&id=<?= htmlspecialchars($parametro['desafio_id']) ?>">Cancelar</a>
</form>
