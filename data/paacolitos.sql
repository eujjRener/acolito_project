-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 24-Jun-2023 às 01:05
-- Versão do servidor: 5.7.36
-- versão do PHP: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `paacolitos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acolitos`
--

CREATE TABLE `acolitos` (
  `id` int(10) NOT NULL,
  `nome_aco` varchar(50) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `nome_mae` varchar(50) DEFAULT NULL,
  `tel_celular` varchar(50) DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `igreja_serve` varchar(50) DEFAULT NULL,
  `created` char(50) DEFAULT NULL,
  `modified` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `acolitos`
--

INSERT INTO `acolitos` (`id`, `nome_aco`, `data_nasc`, `cpf`, `nome_mae`, `tel_celular`, `endereco`, `bairro`, `igreja_serve`, `created`, `modified`) VALUES
(1, 'Jonathan', '2005-05-05', '056.453.718-79', 'Regina', '(16)99999-9999', 'Jardim', 'Alvorada', 'Bom Jesus', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `acolitos`
--
ALTER TABLE `acolitos`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acolitos`
--
ALTER TABLE `acolitos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
