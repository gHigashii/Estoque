<?php
require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../models/TipoProduto.php';

$tipoprodutoModel = new TipoProduto($pdo);

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['novo_tipo'])){
    $tipoprodutoModel->adicionar($_POST['novo_tipo']);
    header("Location: ../painel.php?secao=tipoproduto");
    exit;
}

if(isset($_POST['editar_id'], $_POST['editar_nome'])){
    $tipoprodutoModel->editar($_POST['editar_id'], $_POST['editar_nome']);
    header("Location: ../painel.php?secao=tipoproduto");
    exit;
}

if (isset($_GET['excluir'])) {
    $tipoprodutoModel->excluir($_GET['excluir']);
    header("Location: ../painel.php?secao=tipoproduto");
    exit;
}

$tipos = $tipoprodutoModel->listar();
require_once __DIR__ . '/../views/tipos_produto/listar.php';
