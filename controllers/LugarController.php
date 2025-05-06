<?php
require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../models/lugar.php';

$lugarModel = new Lugar($pdo);

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['novo_lugar'])){
    $lugarModel->adicionar($_POST['novo_lugar']);
    header("Location: ../painel.php?secao=lugar");
    exit;
}

if(isset($_POST['editar_id'], $_POST['editar_nome'])){
    $lugarModel->editar($_POST['editar_id'], $_POST['editar_nome']);
    header("Location: ../painel.php?secao=lugar");
    exit;
}

if (isset($_GET['excluir'])) {
    $lugarModel->excluir($_GET['excluir']);
    header("Location: ../painel.php?secao=lugar");
    exit;
}

$lugares = $lugarModel->listar();
require_once __DIR__ . '/../views/lugar/listar.php';