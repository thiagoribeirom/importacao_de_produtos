CREATE TABLE produtos (
    ean varchar(13) NOT NULL PRIMARY KEY,
    nomeproduto varchar(20) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    estoque INT(5) NOT NULL,
    data DATE,
    PRIMARY KEY (ean)
);