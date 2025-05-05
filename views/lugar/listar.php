<form method="POST" class="mb-4 d-flex">
    <input type="text" name="nova_categoria" class="form-control me-2" placeholder="Nova categoria..." required>
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
        <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td>
                    <form method="POST" class="d-flex">
                        <input type="hidden" name="editar_id" value="<?= $categoria['id_categoria'] ?>">
                        <input type="text" name="editar_nome" class="form-control" value="<?= htmlspecialchars($categoria['nome']) ?>">
                </td>
                <td>
                        <button type="submit" class="btn btn-sm btn-primary me-1">Salvar</button>
                        <a href="controllers/CategoriaController.php?excluir=<?= $categoria['id_categoria'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir esta categoria?')">Excluir</a>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
