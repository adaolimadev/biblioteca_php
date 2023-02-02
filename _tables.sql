CREATE TABLE clientes(
id_cliente int NOT NULL AUTO_INCREMENT,
nome varchar (50) NOT NULL,
cpf varchar (20) NOT NULL UNIQUE,
email varchar (50) NOT NULL,
telefone varchar (20),
PRIMARY KEY (id_cliente) );

INSERT INTO clientes( nome, cpf, email, telefone) values ('Adão', '1111111111', 'teste@teste', '2222222222')

drop table clientes

select * from clientes;


UPDATE clientes (nome, cpf, email, telefone, senha) SET ('teste1', 'teste2', 'teste3', 'teste4', 'teste5');

UPDATE clientes set nome = 'teste1', cpf = 'teste2', email = 'teste3', telefone = 'teste4', senha = 'teste5' where id_cliente = 4;

select * from clientes;


CREATE TABLE admins(
id_admin integer,
user varchar (10),
pass varchar (10)
);


insert into admins values ('admin', 'admin');

CREATE TABLE livros(
id_livro int NOT NULL AUTO_INCREMENT,
titulo varchar(50) not null,
autor varchar (50) not null,
editora varchar (50) not null,
genero varchar (50) not null,
ano varchar (50) not null,
PRIMARY KEY (id_livro)
);


drop table livros 

select * from livros

INSERT INTO LIVROS 

