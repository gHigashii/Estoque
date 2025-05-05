<?php

class TipoProduto{
    private $pdo;
    
        public function __construct($pdo){
            $this->pdo = $pdo;
        }
        
        public function listar(){
            return $this->pdo->query("SELECT * FROM tipoproduto ORDER BY nome")->fetchAll();
        }
        
        public function adicionar($nome){
            $stmt = $this->pdo->prepare("INSERT INTO tipoproduto (nome) VALUES (:nome)");
            return $stmt->execute([':nome' => trim($nome)]);
        }
        
        public function editar($id, $nome){
            $stmt = $this->pdo->prepare("UPDATE tipoproduto SET nome = :nome WHERE id_tipoproduto = :id");
            return $stmt->execute([':nome' => trim($nome), ':id' =>(int)$id]);
        }
        
        public function excluir($id){
            $stmt = $this->pdo->prepare("DELETE FROM tipoproduto WHERE id_tipoproduto = :id");
            return $stmt->execute([':id' => (int)$id]);
        }
}