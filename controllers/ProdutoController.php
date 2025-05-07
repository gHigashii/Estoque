<?php
require_once 'conexao.php';
require_once 'models/Produto.php';

$model = new Produto($pdo);

// Adição de produto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'nome' => $_POST['nome'],
        'categoria' => $_POST['categoria'],
        'tipo' => $_POST['tipo'],
        'tamanho' => $_POST['tamanho'],
        'lugar' => $_POST['lugar'],
        'quantidade' => $_POST['quantidade']
    ];

    $model->adicionar($dados);
    header("Location: painel.php?secao=produtos");
    exit;
}

// Listar opções para selects
$categorias = $model->listarCategorias();
$tipos = $model->listarTipos();
$tamanhos = $model->listarTamanhos();
$lugares = $model->listarLugares();

require 'views/produtos/formulario.php';
