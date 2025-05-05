<?php
require_once 'conexao.php';

// --- Filtros ---
$where = [];
$params = [];

if (!empty($_GET['categoria'])) {
    $where[] = 'p.id_categoria = :categoria';
    $params[':categoria'] = $_GET['categoria'];
}

if (!empty($_GET['tamanho'])) {
    $where[] = 'p.id_tamanho = :tamanho';
    $params[':tamanho'] = $_GET['tamanho'];
}

if (!empty($_GET['nome'])) {
    $where[] = 'p.nome LIKE :nome';
    $params[':nome'] = '%' . $_GET['nome'] . '%';
}

$whereSQL = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$sql = "
    SELECT p.*, c.nome AS categoria_nome, t.nome AS tamanho_nome, tp.nome AS tipo_nome, l.nome AS lugar_nome, e.quantidade
    FROM produto p
    LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
    LEFT JOIN tamanho t ON p.id_tamanho = t.id_tamanho
    LEFT JOIN tipoproduto tp ON p.id_tipoproduto = tp.id_tipoproduto
    LEFT JOIN lugar l ON p.id_lugar = l.id_lugar
    LEFT JOIN estoque e ON p.id_produto = e.id_produto
    $whereSQL
    ORDER BY p.data_criacao DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$produtos = $stmt->fetchAll();

// Buscando dados para filtros
$categorias = $pdo->query("SELECT * FROM categoria")->fetchAll();
$tamanhos = $pdo->query("SELECT * FROM tamanho")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paíto Motors - Estoque</title>

    <!-- Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/general.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <img src="assets/img/logo paito ozinho.png" alt="Logo" height="40" class="d-inline-block align-text-center">
    </a>
    <div class="collapse navbar-collapse">
        <ul class="nav justify-content-center">
            <li class="nav-item mx-3">
                <a href="painel.php">A<img src="" alt=""></a>
            </li>
        </ul>
    </div>
  </div>
</nav>

<nav class="navbar fixed-top">
        <div class="container-fluid">
            
            
        </div>
    </nav>

<!-- Filtros -->
<div class="container mb-4">
    <form method="GET" class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($_GET['nome'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label">Categoria</label>
            <select name="categoria" class="form-select">
                <option value="">Todas</option>
                <?php foreach ($categorias as $c): ?>
                    <option value="<?= $c['id_categoria'] ?>" <?= ($_GET['categoria'] ?? '') == $c['id_categoria'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Tamanho</label>
            <select name="tamanho" class="form-select">
                <option value="">Todos</option>
                <?php foreach ($tamanhos as $t): ?>
                    <option value="<?= $t['id_tamanho'] ?>" <?= ($_GET['tamanho'] ?? '') == $t['id_tamanho'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($t['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>
</div>

<!-- Lista de Produtos -->
<div class="container">
    <h3 class="mb-3">Produtos em Estoque</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Tamanho</th>
                    <th>Tipo</th>
                    <th>Local</th>
                    <th>Qtd</th>
                    <th>Criado em</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($produtos): ?>
                    <?php foreach ($produtos as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['nome']) ?></td>
                            <td><?= htmlspecialchars($p['categoria_nome']) ?></td>
                            <td><?= htmlspecialchars($p['tamanho_nome']) ?></td>
                            <td><?= htmlspecialchars($p['tipo_nome']) ?></td>
                            <td><?= htmlspecialchars($p['lugar_nome']) ?></td>
                            <td><?= (int)$p['quantidade'] ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($p['data_criacao'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center">Nenhum produto encontrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
