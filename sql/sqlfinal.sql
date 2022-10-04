
CREATE TABLE produtos (
  ean varchar(13) NOT NULL,
  nomeproduto varchar(20) NOT NULL,
  preco decimal(10,2) NOT NULL,
  estoque int NOT NULL,
  datafabricacao date DEFAULT NULL,
  PRIMARY KEY (ean)
);
	
CREATE TABLE usuarios (
  id int NOT NULL AUTO_INCREMENT,
  usuario varchar(50) NOT NULL,
  senha varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);


INSERT INTO 'usuarios' ('id', 'usuario', 'senha') VALUES
	(1, 'admin@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$dzZreTFOaUxmVnl5YVRycQ$gPo+N9NIwohavOvMG/W3ifctGRx3BdDGSeJLA+SBzCQ');
	
#echo password_hash("5574", PASSWORD_ARGON2I); 