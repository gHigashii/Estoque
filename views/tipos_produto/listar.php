<form method="POST" class="mb-4 d-flex">
    <input type="text" name="novo_tipo" class="form-control me-2" placeholder="Novo tipo de produto..." required>
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
        <?php foreach ($tipos as $tipo): ?>
            <tr>
                <td>
                    <form method="POST" class="d-flex">
                        <input type="hidden" name="editar_id" value="<?= $tipo['id_tipoproduto'] ?>">
                        <input type="text" name="editar_nome" class="form-control" value="<?= htmlspecialchars($tipo['nome']) ?>">
                </td>
                <td>
                        <button type="submit" class="btn btn-sm btn-primary me-1">Salvar</button>
                        <a href="controllers/TipoProdutoController.php?excluir=<?= $tipo['id_tipoproduto'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este tipo?')">Excluir</a>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
