	DROP DATABASE localizejahu;

	CREATE DATABASE localizejahu;

	USE localizejahu;

	CREATE TABLE usuario(
		id_usuario INT(10) AUTO_INCREMENT PRIMARY KEY,
		nome VARCHAR(80) NOT NULL,
		senha VARCHAR(100) NOT NULL,
		telefone VARCHAR(15) NOT NULL,
		email VARCHAR(80) NOT NULL UNIQUE,
		cpf CHAR(14) NOT NULL UNIQUE, 
		adm ENUM('nao', 'sim') NOT NULL
	);

	-- Promotor
	CREATE TABLE promotor(
		id_promotor INT(10) AUTO_INCREMENT PRIMARY KEY,
		nome_publico VARCHAR(80) NOT NULL,
		telefone_contato VARCHAR(15),
		email_contato VARCHAR(80),
		biografia VARCHAR(800),
		website VARCHAR(255),
		id_usuario INT(10) NOT NULL UNIQUE,
		FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario)
	);

	CREATE TABLE categoria (
		id_categoria INT(10) AUTO_INCREMENT PRIMARY KEY,
		descritivo VARCHAR(80) NOT NULL UNIQUE
	);

	-- Evento
	CREATE TABLE evento (
		id_evento INT(10) AUTO_INCREMENT PRIMARY KEY,
		titulo VARCHAR(80) NOT NULL,
		descricao TEXT,
		logradouro VARCHAR(80) NOT NULL,
		cep CHAR(9) NOT NULL,
		bairro VARCHAR(80) NOT NULL,
		cidade VARCHAR(80) NOT NULL,
		uf CHAR(2),
		situacao ENUM(
			'ativo',
			'desativado',
			'pendente',
			'finalizado',
			'cancelado'
		) NOT NULL,
		imagem VARCHAR(100),
		id_categoria INT(10) NOT NULL,
		FOREIGN KEY (id_categoria) REFERENCES categoria (id_categoria),
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
INSERT INTO `usuario` (`id_usuario`, `nome`, `senha`, `telefone`, `email`, `cpf`, `adm`) VALUES
(1, 'Admin', '$2y$10$aYS7Ms2zBE9FKb1CoKpvue/eW19p.FIFgHn4AMk12xP7cU4pLLqw.', '(11) 1111-11111', 'adm@adm.com', '111.111.111-11', ''),
(2, 'Promotor', '$2y$10$Jcyln0tWGrz7ZhyUNk0Ub.MjoVQ0WOAdrow4YJi1ZBASafpo6vlsq', '(11) 1111-11111', 'promotor@promotor.com', '222.222.222-22', '');


	INSERT INTO
		promotor(
			nome_publico,
			telefone_contato,
			email_contato,
			biografia,
			id_usuario
		)
	VALUES
		("Promotor",
		"121221",
		"promotor@promotor.com",
		"Promotor",
		2);

	INSERT INTO
		categoria (descritivo)
	VALUES
		('Festa'),
		('Show'),
		('Festival'),
		('Exposição'),
		('Encontro'),
		('Feira'),
		('Workshop/Oficina'),
		('Curso'),
		('Esportivo'),
		('Competição'),
		('Caminhada/Corrida'),
		('Palestra'),
		('Religioso'),
		('Evento Académico'),
		('Palestra/Seminário');

	INSERT INTO
		evento (
			descricao,
			titulo,
			imagem,
			logradouro,
			cep,
			bairro,
			cidade,
			uf,
			situacao,
			id_categoria,
			id_promotor
		)
	VALUES
		(
			'Um grande festival de música para todos os públicos.',
			'Festival de Música',
			'evento1.jpg',
			'Av. das Flores, 123',
			'17201-000',
			'Centro',
			'Jaú',
			'SP',
			'ativo',
			3,
			1
		),
		(
			'Lorem ipsum odor amet, consectetuer adipiscing elit. Congue libero vestibulum; suspendisse lacinia varius torquent molestie pulvinar. Dapibus mus laoreet curabitur iaculis; lobortis facilisi curae suspendisse. Aliquam facilisi integer parturient commodo nisi cras rhoncus. Tempor mus ad in, proin ipsum lobortis. Inceptos integer auctor posuere ultrices per vel ante facilisi. Magna facilisi eu commodo finibus cursus aliquam sagittis ornare efficitur.

	Purus pretium morbi aliquet eu iaculis consequat malesuada facilisis donec. Condimentum nibh aenean eu vitae, curae eget interdum. Felis vehicula elit curae amet pellentesque penatibus. Sociosqu libero metus tincidunt mollis volutpat commodo. Himenaeos pharetra torquent odio sollicitudin elit sodales litora per. Nunc ante dapibus; conubia facilisis eleifend etiam semper mi. Sodales leo metus primis aliquet dictumst tempor class ex..',
			'Exposição de Arte Moderna',
			'evento2.jpg',
			'Rua das Artes, 45',
			'17202-100',
			'Vila Nova',
			'Jaú',
			'SP',
			'ativo',
			4,
			1
		),
		(
			'Encontro literário com escritores locais.',
			'Encontro Literário',
			NULL,
			'Praça da Leitura, s/n',
			'17203-200',
			'Jardim das Letras',
			'Jaú',
			'SP',
			'ativo',
			5,
			1
		),
		(
			'Workshop de tecnologia para iniciantes.',
			'Workshop de Tecnologia',
			'evento3.jpg',
			'Rua Tech, 789',
			'17204-300',
			'Parque Industrial',
			'Jaú',
			'SP',
			'ativo',
			7,
			1
		),
		(
			'Corrida beneficente para arrecadar fundos.',
			'Corrida Beneficente',
			'sem-imagem.png',
			'Parque das Palmeiras',
			'17205-400',
			'Residencial Verde',
			'Jaú',
			'SP',
			'ativo',
			11,
			1
		);

	INSERT INTO
		ocorrencia (dia, hora_inicio, hora_termino, id_evento)
	VALUES
		('2024-12-03', '18:00:00', '23:00:00', 1),
		('2024-12-06', '10:00:00', '18:00:00', 2),
		('2024-12-07', '14:00:00', '17:00:00', 2),
		('2024-12-09', '09:00:00', '12:00:00', 3),
		('2024-12-16', '08:00:00', '11:00:00', 3),
		('2024-12-07', '18:00:00', '23:00:00', 4),
		('2024-12-08', '10:00:00', '18:00:00', 4),
		('2024-12-07', '15:00:00', '17:00:00', 5);

