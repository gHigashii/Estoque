<?php
class Produto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function adicionar($dados) {
        $this->pdo->beginTransaction();

        // Inserir na tabela produto
        $stmt = $this->pdo->prepare("INSERT INTO produto (nome, id_categoria, id_tipoproduto, id_tamanho, id_lugar)
            VALUES (:nome, :categoria, :tipo, :tamanho, :lugar)");
        $stmt->execute([
            ':nome' => trim($dados['nome']),
            ':categoria' => $dados['categoria'],
            ':tipo' => $dados['tipo'],
            ':tamanho' => $dados['tamanho'],
            ':lugar' => $dados['lugar']
        ]);

        $id_produto = $this->pdo->lastInsertId();

        // Inserir no estoque
        $stmtEstoque = $this->pdo->prepare("INSERT INTO estoque (id_produto, Quantidade) VALUES (:id_produto, :quantidade)");
        $stmtEstoque->execute([
            ':id_produto' => $id_produto,
            ':quantidade' => $dados['quantidade']
        ]);

        return $this->pdo->commit();
    }

    public function listarCategorias() {
        return $this->pdo->query("SELECT * FROM categoria ORDER BY nome")->fetchAll();
    }

    public function listarTipos() {
        return $this->pdo->query("SELECT * FROM tipoproduto ORDER BY nome")->fetchAll();
    }

    public function listarTamanhos() {
        return $this->pdo->query("SELECT * FROM tamanho ORDER BY nome")->fetchAll();
    }

    public function listarLugares() {
        return $this->pdo->query("SELECT * FROM lugar ORDER BY nome")->fetchAll();
    }
}
