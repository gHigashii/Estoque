-- Tabela de categorias
CREATE TABLE categoria (
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(30) NOT NULL UNIQUE
);

-- Tipos de produtos
CREATE TABLE tipoproduto (
    id_tipoproduto INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(30) NOT NULL UNIQUE
);

-- Tamanhos
CREATE TABLE tamanho (
    id_tamanho INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(6) NOT NULL UNIQUE
);

-- Locais de armazenamento
CREATE TABLE lugar (
    id_lugar INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL UNIQUE
);

-- Produtos
CREATE TABLE produto (
    id_produto INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    id_categoria INT,
    id_tipoproduto INT,
    id_tamanho INT,
    id_lugar INT,
    data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    data_alteracao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria),
    FOREIGN KEY (id_tipoproduto) REFERENCES tipoproduto(id_tipoproduto),
    FOREIGN KEY (id_tamanho) REFERENCES tamanho(id_tamanho),
    FOREIGN KEY (id_lugar) REFERENCES lugar(id_lugar)
);

-- Controle de estoque
CREATE TABLE estoque (
    id_estoque INT PRIMARY KEY AUTO_INCREMENT,
    id_produto INT NOT NULL,
    quantidade INT NOT NULL CHECK (quantidade >= 0),
    data_modificacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (id_produto) REFERENCES produto(id_produto) ON DELETE CASCADE
);
