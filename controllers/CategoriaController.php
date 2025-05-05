<?php
require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../models/Categoria.php';

$categoriaModel = new Categoria($pdo);

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nova_categoria'])){
    $categoriaModel->adicionar($_POST['nova_categoria']);
    header("Location: painel.php?secao=categoria");
    exit;
}

if(isset($_POST['editar_id'], $_POST['editar_nome'])){
    $categoriaModel->editar($_POST['editar_id'], $_POST['editar_nome']);
    header("Location: painel.php?secao=categoria");
    exit;
}

if (isset($_GET['excluir'])) {
    $categoriaModel->excluir($_GET['excluir']);
    header("Location: ../painel.php?secao=categoria");
    exit;
}

$categorias = $categoriaModel->listar();
require_once __DIR__ . '/../views/categorias/listar.php';