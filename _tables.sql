CREATE TABLE clientes(
id_cliente int NOT NULL AUTO_INCREMENT,
nome varchar (50) NOT NULL,
cpf varchar (20) NOT NULL UNIQUE,
email varchar (50) NOT NULL,
telefone varchar (20),
senha varchar (50),
PRIMARY KEY (id_cliente) );

INSERT INTO clientes( nome, cpf, email, telefone) values ('Adão', '1111111', 'adao@teste.com', '1111111');

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
ano int not null,
disponivel boolean not null,
PRIMARY KEY (id_livro)
);

UPDATE livros set disponivel = true where id_livro IN (1,2);

update livros set disponivel = true where disponivel = false;

INSERT INTO livros ( titulo , autor , editora , genero , ano, disponivel) values ('A Bíblia', 'Discípulos', 'Céu', 'Religioso', 1 );
INSERT INTO livros ( titulo , autor , editora , genero , ano, disponivel) values ('A copa', 'Discípulos', 'Céu', 'Religioso', 1 );
INSERT INTO livros ( titulo , autor , editora , genero , ano, disponivel) values ('A Bíblia', 'Discípulos', 'Céu', 'Religioso', 1 );
INSERT INTO livros ( titulo , autor , editora , genero , ano, disponivel) values ('A Bíblia', 'Discípulos', 'Céu', 'Religioso', 1 );

drop table livros 

select * from livros

-------
CREATE TABLE emprestimos (
id_emprestimo INT AUTO_INCREMENT PRIMARY KEY,
id_cliente INT not null,
data_emp date not null,
data_dev date,
obs varchar(50) not null,
status boolean not null,
CONSTRAINT fk_cliente FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente));

INSERT INTO emprestimos (id_cliente,data_emp, obs, status) values ( 1,CURRENT_TIMESTAMP ,'Emprestado por 3 dias', true);

update emprestimos set data_dev = CURRENT_TIMESTAMP,  status = false WHERE id_emprestimo = 2;

selecT * from emprestimos;
select * from livros

drop table clientes;
drop table livros;
drop table emprestimos;

CREATE OR REPLACE VIEW vwEmprestimos AS 
SELECT emp.id_emprestimo cod, emp.id_cliente id_cliente, cli.nome nome_cliente, emp.data_emp data_emp, emp.data_dev data_dev, emp.obs obs, emp.status status
FROM emprestimos emp, clientes cli
WHERE emp.id_cliente = cli.id_cliente;

select * from vwEmprestimos

CREATE TABLE livros_emp (
id_livrosEmp INT AUTO_INCREMENT PRIMARY KEY,
id_emprestimo int not null,
id_livro int not null,
CONSTRAINT fk_idEmprestimo FOREIGN KEY (id_emprestimo) REFERENCES emprestimos (id_emprestimo),
CONSTRAINT fk_Idlivro FOREIGN KEY (id_livro) REFERENCES livros (id_livro));

select * from livros_emp;