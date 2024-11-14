CREATE DATABASE localizejahu;
USE localizejahu;
DROP DATABASE localizejahu;

CREATE TABLE usuario(
	id_usuario INT(10) AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(80) NOT NULL,
	nome_usuario VARCHAR(80) NOT NULL UNIQUE,
	senha VARCHAR(80) NOT NULL,
	telefone VARCHAR(15) NOT NULL,
	email VARCHAR(80) NOT NULL UNIQUE,
	cpf CHAR(14) NOT NULL UNIQUE,
	adm BIT NOT NULL
);

-- Promotor

CREATE TABLE promotor(
	id_promotor INT(10) AUTO_INCREMENT PRIMARY KEY,
	nome_publico VARCHAR(80) NOT NULL,
	telefone_contato VARCHAR(15),
	email_contato VARCHAR(80),
	biografia VARCHAR(800),
	condicao INT(1) NOT NULL,
	id_usuario INT(10) NOT NULL UNIQUE,
	FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario)
);

CREATE TABLE website(
	id_website INT(10) AUTO_INCREMENT PRIMARY KEY,
	website VARCHAR(80) NOT NULL,
	id_promotor INT(10) NOT NULL,
	FOREIGN KEY (id_promotor) REFERENCES promotor (id_promotor)
);

CREATE TABLE categoria (
	id_categoria INT(10) AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(80) NOT NULL UNIQUE
);

CREATE TABLE estado (
	id_estado INT(10) AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(80)
);

-- Evento

CREATE TABLE evento (
	id_evento INT(10) AUTO_INCREMENT PRIMARY KEY,
	descricao TEXT,
	titulo VARCHAR(80) NOT NULL,
	logradouro VARCHAR(80) NOT NULL,
	cep CHAR(9) NOT NULL,
	bairro VARCHAR(80) NOT NULL,
	cidade VARCHAR(80) NOT NULL,
	uf CHAR(2),
	condicao INT(1) NOT NULL,
	imagem LONGBLOB,
	id_categoria INT(10) NOT NULL,
	FOREIGN KEY (id_categoria) REFERENCES categoria (id_categoria),
	id_estado INT(10) NOT NULL,
	FOREIGN KEY (id_estado) REFERENCES estado (id_estado)
);

CREATE TABLE responsavel(
	id_responsavel INT(10) AUTO_INCREMENT PRIMARY KEY,
	id_evento INT(10) NOT NULL,
	FOREIGN KEY (id_evento) REFERENCES evento (id_evento),
	id_promotor INT(10) NOT NULL,
	FOREIGN KEY (id_promotor) REFERENCES promotor (id_promotor)
);

CREATE TABLE ocorrencia(
	id_ocorrencia INT(10) AUTO_INCREMENT PRIMARY KEY,
	dia DATE NOT NULL,
	hora_inicio TIME NOT NULL,
	hora_termino TIME,
	id_evento INT(10) NOT NULL,
	FOREIGN KEY (id_evento) REFERENCES evento (id_evento)
);


##Dados
