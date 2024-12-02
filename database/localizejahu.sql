-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/12/2024 às 13:54
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `localizejahu`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(10) NOT NULL,
  `descritivo` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `descritivo`) VALUES
(11, 'Caminhada/Corrida'),
(10, 'Competição'),
(8, 'Curso'),
(5, 'Encontro'),
(9, 'Esportivo'),
(14, 'Evento Académico'),
(4, 'Exposição'),
(6, 'Feira'),
(1, 'Festa'),
(3, 'Festival'),
(12, 'Palestra'),
(15, 'Palestra/Seminário'),
(13, 'Religioso'),
(2, 'Show'),
(7, 'Workshop/Oficina');

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento`
--

CREATE TABLE `evento` (
  `id_evento` int(10) NOT NULL,
  `titulo` varchar(80) NOT NULL,
  `descricao` text DEFAULT NULL,
  `logradouro` varchar(80) NOT NULL,
  `cep` char(9) NOT NULL,
  `bairro` varchar(80) NOT NULL,
  `cidade` varchar(80) NOT NULL,
  `uf` char(2) DEFAULT NULL,
  `situacao` enum('ativo','desativado','pendente','finalizado','cancelado') NOT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `acessos` int(10) DEFAULT 0,
  `id_categoria` int(10) NOT NULL,
  `id_promotor` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `evento`
--

INSERT INTO `evento` (`id_evento`, `titulo`, `descricao`, `logradouro`, `cep`, `bairro`, `cidade`, `uf`, `situacao`, `imagem`, `acessos`, `id_categoria`, `id_promotor`) VALUES
(1, 'Festival de Música', 'Um grande festival de música para todos os públicos.', 'Av. das Flores, 123', '17201-000', 'Centro', 'Jaú', 'SP', 'ativo', 'evento1.jpg', 105, 3, 1),
(2, 'Exposição de Arte Moderna', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Congue libero vestibulum; suspendisse lacinia varius torquent molestie pulvinar. Dapibus mus laoreet curabitur iaculis; lobortis facilisi curae suspendisse. Aliquam facilisi integer parturient commodo nisi cras rhoncus. Tempor mus ad in, proin ipsum lobortis. Inceptos integer auctor posuere ultrices per vel ante facilisi. Magna facilisi eu commodo finibus cursus aliquam sagittis ornare efficitur.\r\n\r\n	Purus pretium morbi aliquet eu iaculis consequat malesuada facilisis donec. Condimentum nibh aenean eu vitae, curae eget interdum. Felis vehicula elit curae amet pellentesque penatibus. Sociosqu libero metus tincidunt mollis volutpat commodo. Himenaeos pharetra torquent odio sollicitudin elit sodales litora per. Nunc ante dapibus; conubia facilisis eleifend etiam semper mi. Sodales leo metus primis aliquet dictumst tempor class ex..', 'Rua das Artes, 45', '17202-100', 'Vila Nova', 'Jaú', 'SP', 'ativo', 'evento2.jpg', 98, 4, 1),
(3, 'Encontro Literário', 'Encontro literário com escritores locais.', 'Praça da Leitura, s/n', '17203-200', 'Jardim das Letras', 'Jaú', 'SP', 'ativo', 'evento7.jpg', 220, 5, 1),
(4, 'Workshop de Tecnologia', 'Workshop de tecnologia para iniciantes.', 'Rua Tech, 789', '17204-300', 'Parque Industrial', 'Jaú', 'SP', 'ativo', 'evento3.jpg', 35, 7, 1),
(5, 'Corrida Beneficente', 'Corrida beneficente para arrecadar fundos.', 'Parque das Palmeiras', '17205-400', 'Residencial Verde', 'Jaú', 'SP', 'ativo', 'evento8.jpg', 47, 11, 1),
(6, 'Concerto de Ano Novo', 'Concerto clássico ao ar livre.', 'Praça Central, 123', '17210-000', 'Centro', 'Jaú', 'SP', 'ativo', '674daca496da4.jpg', 80, 2, 1),
(7, 'Festival Gastronômico', 'Festival gastronômico com comidas típicas.', 'Av. Gourmet, 456', '17211-100', 'Alto da Colina', 'Jaú', 'SP', 'ativo', '674dacd99dad0.jpg', 120, 1, 1),
(8, 'Night Run Jaú', 'Corrida noturna pela cidade.', 'Parque das Palmeiras', '17205-400', 'Residencial Verde', 'Jaú', 'SP', 'ativo', '674dad079f7d3.jpg', 96, 11, 1),
(9, 'Inovação 2025', 'Palestra sobre inovação e tecnologia.', 'Auditório Tecnológico, 789', '17212-200', 'Tecnoparque', 'Jaú', 'SP', 'ativo', '674dad410c873.jpg', 51, 12, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ocorrencia`
--

CREATE TABLE `ocorrencia` (
  `id_ocorrencia` int(10) NOT NULL,
  `dia` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_termino` time DEFAULT NULL,
  `id_evento` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ocorrencia`
--

INSERT INTO `ocorrencia` (`id_ocorrencia`, `dia`, `hora_inicio`, `hora_termino`, `id_evento`) VALUES
(1, '2024-12-03', '18:00:00', '23:00:00', 1),
(2, '2024-12-06', '10:00:00', '18:00:00', 2),
(3, '2024-12-07', '14:00:00', '17:00:00', 2),
(4, '2024-12-09', '09:00:00', '12:00:00', 3),
(5, '2024-12-16', '08:00:00', '11:00:00', 3),
(6, '2024-12-07', '18:00:00', '23:00:00', 4),
(7, '2024-12-08', '10:00:00', '18:00:00', 4),
(8, '2024-12-07', '15:00:00', '17:00:00', 5),
(9, '2024-12-31', '20:00:00', '23:59:00', 6),
(10, '2024-12-31', '12:00:00', '18:00:00', 7),
(11, '2024-12-30', '18:00:00', '22:00:00', 7),
(12, '2025-01-06', '19:00:00', '21:00:00', 8),
(13, '2025-01-08', '09:00:00', '12:00:00', 9),
(14, '2025-01-15', '15:00:00', '17:00:00', 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `promotor`
--

CREATE TABLE `promotor` (
  `id_promotor` int(10) NOT NULL,
  `nome_publico` varchar(80) NOT NULL,
  `telefone_contato` varchar(15) DEFAULT NULL,
  `email_contato` varchar(80) DEFAULT NULL,
  `biografia` varchar(800) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `id_usuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `promotor`
--

INSERT INTO `promotor` (`id_promotor`, `nome_publico`, `telefone_contato`, `email_contato`, `biografia`, `website`, `id_usuario`) VALUES
(1, 'Promotor', '121221', 'promotor@promotor.com', 'Promotor', NULL, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(10) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(80) NOT NULL,
  `cpf` char(14) NOT NULL,
  `adm` enum('nao','sim') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `senha`, `telefone`, `email`, `cpf`, `adm`) VALUES
(1, 'Admin', '$2y$10$aYS7Ms2zBE9FKb1CoKpvue/eW19p.FIFgHn4AMk12xP7cU4pLLqw.', '(11) 1111-11111', 'adm@adm.com', '111.111.111-11', 'sim'),
(2, 'Promotor', '$2y$10$Jcyln0tWGrz7ZhyUNk0Ub.MjoVQ0WOAdrow4YJi1ZBASafpo6vlsq', '(11) 1111-11111', 'promotor@promotor.com', '222.222.222-22', 'nao'),
(3, 'usuario', '$2y$10$.8lDSPlriQyhHXtfDZ3io.F1nWMGgYPNPPKSUllqdi28MfIDzlYHu', '12321', 'usuario@usuario.com', '12312', 'nao');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `descritivo` (`descritivo`);

--
-- Índices de tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_promotor` (`id_promotor`);

--
-- Índices de tabela `ocorrencia`
--
ALTER TABLE `ocorrencia`
  ADD PRIMARY KEY (`id_ocorrencia`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Índices de tabela `promotor`
--
ALTER TABLE `promotor`
  ADD PRIMARY KEY (`id_promotor`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
  MODIFY `id_evento` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `ocorrencia`
--
ALTER TABLE `ocorrencia`
  MODIFY `id_ocorrencia` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `promotor`
--
ALTER TABLE `promotor`
  MODIFY `id_promotor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `evento_ibfk_2` FOREIGN KEY (`id_promotor`) REFERENCES `promotor` (`id_promotor`);

--
-- Restrições para tabelas `ocorrencia`
--
ALTER TABLE `ocorrencia`
  ADD CONSTRAINT `ocorrencia_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id_evento`);

--
-- Restrições para tabelas `promotor`
--
ALTER TABLE `promotor`
  ADD CONSTRAINT `promotor_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
