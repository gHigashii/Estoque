<?php
require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../models/tamanho.php';

$TamanhoModel = new tamanho($pdo);

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['novo_tamanho'])){
    $TamanhoModel->adicionar($_POST['novo_tamanho']);
    header("Location: painel.php?secao=tamanho");
    exit;
}

if(isset($_POST['editar_id'], $_POST['editar_nome'])){
    $TamanhoModel->editar($_POST['editar_id'], $_POST['editar_nome']);
    header("Location: painel.php?secao=tamanho");
    exit;
}

if (isset($_GET['excluir'])) {
    $TamanhoModel->excluir($_GET['excluir']);
    header("Location: ../painel.php?secao=tamanho");
    exit;
}

$tamanhos = $TamanhoModel->listar();
require_once __DIR__ . '/../views/tamanho/listar.php';