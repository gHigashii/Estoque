<?php

class Categoria{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    
    public function listar(){
        return $this->pdo->query("SELECT * FROM categoria ORDER BY nome")->fetchAll();
    }
    
    public function adicionar($nome){
        $stmt = $this->pdo->prepare("INSERT INTO categoria (nome) VALUES (:nome)");
        return $stmt->execute([':nome' => trim($nome)]);
    }
    
    public function editar($id, $nome){
        $stmt = $this->pdo->prepare("UPDATE categoria SET nome = :nome WHERE id_categoria = :id");
        return $stmt->execute([':nome' => trim($nome), ':id' =>(int)$id]);
    }
    
    public function excluir($id){
        $stmt = $this->pdo->prepare("DELETE FROM categoria WHERE id_categoria = :id");
        return $stmt->execute([':id' => (int)$id]);
    }    
}