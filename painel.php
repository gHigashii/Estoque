<?php
  require 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/profile.css">
</head>
<body>
<div class="container mt-5 container-profile">
        <h1 class="text-center">Bem-vindo ao painel</h1>
        <hr>
        <div class="row">
            <h2>Gerenciar</h2>
            <div class="col-sm-12 col-md-4 col-lg-2">
                <div class="button" onclick="showContent('categoria')">
                    <img src="assets/svg/fields.svg" alt="Ícone de Categoria" width="20">
                    Categorias
                </div>
                <div class="button" onclick="showContent('tipoproduto')">
                    <img src="assets/svg/fields.svg" alt="Ícone de Tipo produto" width="20">
                    Tipo Produto
                </div>
                <div class="button" onclick="showContent('tamanho')">
                    <img src="assets/svg/fields.svg" alt="Ícone de Tamanho" width="20">
                    Tamanho
                </div>
                <div class="button" onclick="showContent('lugar')">
                    <img src="assets/svg/fields.svg" alt="Ícone de Lugar" width="20">
                    Lugar
                </div>                

                <hr>
                <h2>Controle</h2>
                <!-- Campos para serem tratados depois -->
                <div class="button" onclick="window.location.href='cadastro.php'">
                    <img src="assets/svg/fields.svg" alt="Ícone de Editar Campos" width="20">
                    Adicionar Produto
                </div>

                <hr>
                <div class="button" onclick="window.location.href='../index.php'">
                    <img src="assets/svg/fields.svg" alt="Ícone de Editar Campos" width="20">
                    Voltar
                </div>
            </div>

            <div class="col-sm-12 col-md-8 col-lg-10">                
                <div id="estoque" class="content-area overflow-auto hidden">
                    <h2>Gerenciar Estoque</h2>
                    <p>Aqui você pode gerenciar o estoque de produtos.</p>
                    <hr>
                </div>
                <div id="categoria" class="content-area hidden">
                    <h2>Gerenciar Categorias</h2>
                    <?php include './controllers/CategoriaController.php'; ?>
                </div>
                <div id="tipoproduto" class="content-area hidden">
                    <h2>Gerenciar Tipos de Produtos</h2>
                    <?php include './controllers/TipoProdutoController.php'; ?>
                </div>
                <div id="tamanho" class="content-area hidden">
                    <h2>Gerenciar Tamanhos</h2>
                    <?php include './controllers/TamanhoController.php'; ?>
                </div>
                <div id="lugar" class="content-area hidden">
                    <h2>Gerenciar Lugares</h2>
                    <?php include './controllers/LugarController.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showContent(selecao) {
            // Esconde todas as áreas
            const sections = document.querySelectorAll('.content-area');
            sections.forEach(section => section.classList.add('hidden'));

            // Mostra apenas a selecionada
            const id = selecao.toLowerCase().replace(' ', '_'); // Ex: "tipo produto" → "tipo_produto"
            const target = document.getElementById(id);
            if (target) {
                target.classList.remove('hidden');
            }
        }
    </script>


</body>
</html>
