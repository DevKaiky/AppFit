-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/09/2025 às 22:54
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fitness`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `desafios`
--

CREATE TABLE `desafios` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `nivel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `desafios`
--

INSERT INTO `desafios` (`id`, `titulo`, `descricao`, `nivel`) VALUES
(3, 'bicicleta', '100km', ''),
(4, 'caminhada', '2km', 'Iniciante');

-- --------------------------------------------------------

--
-- Estrutura para tabela `participacoes`
--

CREATE TABLE `participacoes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `desafio_id` int(11) NOT NULL,
  `data_inscricao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `participacoes`
--

INSERT INTO `participacoes` (`id`, `usuario_id`, `desafio_id`, `data_inscricao`) VALUES
(4, 2, 3, '2025-09-25 20:11:51'),
(8, 4, 3, '2025-09-25 20:36:10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `progressos`
--

CREATE TABLE `progressos` (
  `id` int(11) NOT NULL,
  `participacao_id` int(11) NOT NULL,
  `data_registo` timestamp NOT NULL DEFAULT current_timestamp(),
  `observacao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL DEFAULT 'user',
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `data_criacao`) VALUES
(2, 'Kaka Miguel', 'kakamiguel@gmail.com', '$2y$10$0gkB7ZKkFNNoaGXxE5APo.VQtvGUCOKzc2L24.WENg1DkU.J1n91e', 'admin', '2025-09-25 17:28:03'),
(3, 'aluno 01', 'aluno01@gmail.com', '$2y$10$YDV/0jAHyc9SiczxDKIru.j2eKUzcHoPP9qa.gUsEDIWFgMZl2gGe', 'user', '2025-09-25 18:06:11'),
(4, 'aluno 02', 'aluno02@gmail.com', '$2y$10$jkDjsTVePVoejJMCUHEzheoPgcx2sZjPuVr2sG8GmKrz9Li2m0Mzm', 'user', '2025-09-25 18:20:20'),
(5, 'aluno 03', 'aluno03@gmail.com', '$2y$10$kw6bqmKoF7.ZI8swz8oseu5VSl8wdBVSzwqM4Pe8WPPFPPDyxURkC', 'user', '2025-09-25 18:25:56');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `desafios`
--
ALTER TABLE `desafios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `participacoes`
--
ALTER TABLE `participacoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`,`desafio_id`),
  ADD KEY `desafio_id` (`desafio_id`);

--
-- Índices de tabela `progressos`
--
ALTER TABLE `progressos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participacao_id` (`participacao_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `desafios`
--
ALTER TABLE `desafios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `participacoes`
--
ALTER TABLE `participacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `progressos`
--
ALTER TABLE `progressos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `participacoes`
--
ALTER TABLE `participacoes`
  ADD CONSTRAINT `participacoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participacoes_ibfk_2` FOREIGN KEY (`desafio_id`) REFERENCES `desafios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `progressos`
--
ALTER TABLE `progressos`
  ADD CONSTRAINT `progressos_ibfk_1` FOREIGN KEY (`participacao_id`) REFERENCES `participacoes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
