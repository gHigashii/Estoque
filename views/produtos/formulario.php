<h2>Adicionar Produto</h2>
<form method="POST" class="row g-3">

    <div class="col-md-6">
        <label for="nome" class="form-label">Nome do Produto</label>
        <input type="text" name="nome" id="nome" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label for="categoria" class="form-label">Categoria</label>
        <select name="categoria" id="categoria" class="form-select" required>
            <option value="">Selecione...</option>
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id_categoria'] ?>"><?= htmlspecialchars($cat['nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-6">
        <label for="tipo" class="form-label">Tipo de Produto</label>
        <select name="tipo" id="tipo" class="form-select" required>
            <option value="">Selecione...</option>
            <?php foreach ($tipos as $tipo): ?>
                <option value="<?= $tipo['id_tipoproduto'] ?>"><?= htmlspecialchars($tipo['nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-6">
        <label for="tamanho" class="form-label">Tamanho</label>
        <select name="tamanho" id="tamanho" class="form-select" required>
            <option value="">Selecione...</option>
            <?php foreach ($tamanhos as $tam): ?>
                <option value="<?= $tam['id_tamanho'] ?>"><?= htmlspecialchars($tam['nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-6">
        <label for="lugar" class="form-label">Local de Armazenamento</label>
        <select name="lugar" id="lugar" class="form-select" required>
            <option value="">Selecione...</option>
            <?php foreach ($lugares as $lugar): ?>
                <option value="<?= $lugar['id_lugar'] ?>"><?= htmlspecialchars($lugar['nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-6">
        <label for="quantidade" class="form-label">Quantidade Inicial</label>
        <input type="number" name="quantidade" id="quantidade" class="form-control" required min="0">
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-success">Salvar Produto</button>
    </div>
</form>
