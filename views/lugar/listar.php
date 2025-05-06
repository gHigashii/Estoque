<form method="POST" action="controllers/LugarController.php" class="mb-4 d-flex">
    <input type="text" name="novo_lugar" class="form-control me-2" placeholder="Novo lugar..." required>
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
        <?php foreach ($lugares as $lugar): ?>
            <tr>
                <td>
                    <form method="POST" action="controllers/LugarController.php" class="d-flex">
                        <input type="hidden" name="editar_id" value="<?= $lugar['id_lugar'] ?>">
                        <input type="text" name="editar_nome" class="form-control" value="<?= htmlspecialchars($lugar['nome']) ?>">
                </td>
                <td>
                        <button type="submit" class="btn btn-sm btn-primary me-1">Salvar</button>
                        <a href="controllers/LugarController.php?excluir=<?= $lugar['id_lugar'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir esta categoria?')">Excluir</a>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
