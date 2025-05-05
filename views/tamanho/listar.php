<!-- Formulário para nova categoria -->
<form method="POST" class="mb-4 d-flex">
    <input type="text" name="novo_tamanho" class="form-control me-2" placeholder="Novo tamanho..." required>
    <button type="submit" class="btn btn-success">Adicionar</button>
</form>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>Nome</th>
            <th style="width: 150px;">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tamanhos as $tamanho): ?>
            <tr>
                <td>
                    <form method="POST" class="d-flex">
                        <input type="hidden" name="editar_id" value="<?= $tamanho['id_tamanho'] ?>">
                        <input type="text" name="editar_nome" class="form-control" value="<?= htmlspecialchars($tamanho['nome']) ?>">
                </td>
                <td>
                        <button type="submit" class="btn btn-sm btn-primary me-1">Salvar</button>
                        <a href="controllers/TamanhoController.php?excluir=<?= $tamanho['id_tamanho'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este tamanho?')">Excluir</a>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
