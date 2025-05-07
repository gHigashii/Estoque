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
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      data-mdb-collapse-init
      class="navbar-toggler"
      type="button"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
        <img src="assets/img/logo paito ozinho.png" height="45" alt="MDB Logo" loading="lazy"/>
      </a>

      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#">Painel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Brigadeiro</a>
        </li>
      </ul>
    </div>

    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Icon -->
      <a class="link-secondary me-3" href="#">
        <i class="fas fa-shopping-cart"></i>
      </a>
      <!-- Avatar -->
      <div class="dropdown">
        <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
          <img src="assets/svg/edit.svg" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy"/>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
          <li>
            <a class="dropdown-item" href="#">My profile</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Settings</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Logout</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->

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
