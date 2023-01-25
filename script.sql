-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2023 at 06:07 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistema_estoque`
--
-- -----------------------------------------------------
-- Schema Sistema_Estoque
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Sistema_Estoque` DEFAULT CHARACTER SET utf8mb4 ;
USE `Sistema_Estoque` ;
-- --------------------------------------------------------

--
-- Table structure for table `alimeto_diario`
--

CREATE TABLE `alimeto_diario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(45) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `preco` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `descricao` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `create_at`, `update_at`, `descricao`, `status`) VALUES
(1, 'Break Fast', '2023-01-19 16:59:22', '2023-01-19 16:59:22', 'Alimento', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `contacto` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nascimento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `codigo_barra`
--

CREATE TABLE `codigo_barra` (
  `id` int(11) NOT NULL,
  `cod` varchar(200) NOT NULL,
  `categoria` int(11) UNSIGNED NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE `compra` (
  `id` int(10) UNSIGNED NOT NULL,
  `preco` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `valor_pago` decimal(7,2) NOT NULL,
  `qtd` int(11) NOT NULL,
  `fornecedor` int(10) UNSIGNED NOT NULL,
  `produto` int(10) UNSIGNED NOT NULL,
  `usuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `conta_pedido`
--

CREATE TABLE `conta_pedido` (
  `id` int(10) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `escola` int(10) UNSIGNED NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `entrada_caixa`
--

CREATE TABLE `entrada_caixa` (
  `id` int(10) UNSIGNED NOT NULL,
  `total` decimal(5,2) NOT NULL,
  `valor_pago` decimal(5,2) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario` int(10) UNSIGNED NOT NULL,
  `forma_pagamento` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `entrada_estoque`
--

CREATE TABLE `entrada_estoque` (
  `id` int(10) UNSIGNED NOT NULL,
  `qtd` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `produto` int(10) UNSIGNED NOT NULL,
  `usuario` int(10) UNSIGNED NOT NULL,
  `lote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `escola`
--

CREATE TABLE `escola` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(225) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `contacto` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lote`
--

CREATE TABLE `lote` (
  `id` int(11) NOT NULL,
  `lote` varchar(100) NOT NULL,
  `data_exp` varchar(100) NOT NULL,
  `data_prod` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nivel_usuario`
--

CREATE TABLE `nivel_usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nivel` tinyint(4) NOT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nivel_usuario`
--

INSERT INTO `nivel_usuario` (`id`, `nivel`, `nome`) VALUES
(1, 0, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE `pedido` (
  `id` int(10) UNSIGNED NOT NULL,
  `produto` int(10) UNSIGNED DEFAULT NULL,
  `alimento_diario` int(10) UNSIGNED DEFAULT NULL,
  `escola` int(10) UNSIGNED NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produto`
--

CREATE TABLE `produto` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(45) NOT NULL,
  `preco` decimal(6,2) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria` int(10) UNSIGNED NOT NULL,
  `codigo_barra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `saida_caixa`
--

CREATE TABLE `saida_caixa` (
  `id` int(10) UNSIGNED NOT NULL,
  `valor` decimal(5,2) NOT NULL,
  `justificativa` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `saida_caixa` int(10) UNSIGNED NOT NULL,
  `usuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `saida_estoque`
--

CREATE TABLE `saida_estoque` (
  `id` int(10) UNSIGNED NOT NULL,
  `justificativa` text NOT NULL,
  `voltou` enum('YES','NOT') NOT NULL DEFAULT 'NOT',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `qtd` int(11) NOT NULL,
  `usuario` int(10) UNSIGNED NOT NULL,
  `produto` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(225) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `nivel_usuario` int(10) UNSIGNED NOT NULL,
  `imagem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `create_at`, `update_at`, `nivel_usuario`, `imagem`) VALUES
(1, 'Victor', 'clevervictor03@gmail.com', '$2y$10$Q0NHOGcVL74Si5GamJHcAO/AXSmVyI5Y7baV8I7lHMkemmBSN5Iva', '2023-01-05 23:36:47', '2023-01-05 23:36:47', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `venda`
--

CREATE TABLE `venda` (
  `id` int(10) UNSIGNED NOT NULL,
  `qtd` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `produto` int(10) UNSIGNED DEFAULT NULL,
  `entrada_caixa` int(10) UNSIGNED NOT NULL,
  `prato_dia` int(10) UNSIGNED DEFAULT NULL,
  `cliente` int(10) UNSIGNED DEFAULT NULL,
  `escola` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alimeto_diario`
--
ALTER TABLE `alimeto_diario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `codigo_barra`
--
ALTER TABLE `codigo_barra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_codigo_barra_categoria1` (`categoria`);

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_compra_fornecedor1` (`fornecedor`),
  ADD KEY `fk_compra_produto1` (`produto`),
  ADD KEY `fk_compra_usuario1` (`usuario`);

--
-- Indexes for table `conta_pedido`
--
ALTER TABLE `conta_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_conta_pedido_escola1` (`escola`);

--
-- Indexes for table `entrada_caixa`
--
ALTER TABLE `entrada_caixa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_conta_usuario1` (`usuario`);

--
-- Indexes for table `entrada_estoque`
--
ALTER TABLE `entrada_estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entrada_estoque_produto1` (`produto`),
  ADD KEY `fk_entrada_estoque_usuario1` (`usuario`),
  ADD KEY `fk_entrada_estoque_lote1` (`lote`);

--
-- Indexes for table `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nivel_usuario`
--
ALTER TABLE `nivel_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedido_produto1` (`produto`),
  ADD KEY `fk_pedido_prato_dia1` (`alimento_diario`),
  ADD KEY `fk_pedido_escola1` (`escola`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produto_categoria1` (`categoria`),
  ADD KEY `fk_produto_codigo_barra1` (`codigo_barra`);

--
-- Indexes for table `saida_caixa`
--
ALTER TABLE `saida_caixa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_saida_conta_conta1` (`saida_caixa`),
  ADD KEY `fk_saida_conta_usuario1` (`usuario`);

--
-- Indexes for table `saida_estoque`
--
ALTER TABLE `saida_estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_saida_estoque_usuario1` (`usuario`),
  ADD KEY `fk_saida_estoque_produto1` (`produto`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_nivel_usuario1` (`nivel_usuario`);

--
-- Indexes for table `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_item_venda_produto1` (`produto`),
  ADD KEY `fk_item_venda_conta1` (`entrada_caixa`),
  ADD KEY `fk_item_venda_prato_dia1` (`prato_dia`),
  ADD KEY `fk_venda_cliente1` (`cliente`),
  ADD KEY `fk_venda_escola1` (`escola`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alimeto_diario`
--
ALTER TABLE `alimeto_diario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `codigo_barra`
--
ALTER TABLE `codigo_barra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conta_pedido`
--
ALTER TABLE `conta_pedido`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entrada_caixa`
--
ALTER TABLE `entrada_caixa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entrada_estoque`
--
ALTER TABLE `entrada_estoque`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `escola`
--
ALTER TABLE `escola`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lote`
--
ALTER TABLE `lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nivel_usuario`
--
ALTER TABLE `nivel_usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saida_caixa`
--
ALTER TABLE `saida_caixa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saida_estoque`
--
ALTER TABLE `saida_estoque`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_fornecedor1` FOREIGN KEY (`fornecedor`) REFERENCES `fornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra_produto1` FOREIGN KEY (`produto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `conta_pedido`
--
ALTER TABLE `conta_pedido`
  ADD CONSTRAINT `fk_conta_pedido_escola1` FOREIGN KEY (`escola`) REFERENCES `escola` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `codigo_barra`
--
ALTER TABLE `codigo_barra`
  ADD CONSTRAINT `fk_codigo_barra_categoria1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `entrada_caixa`
--
ALTER TABLE `entrada_caixa`
  ADD CONSTRAINT `fk_conta_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `entrada_estoque`
--
ALTER TABLE `entrada_estoque`
  ADD CONSTRAINT `fk_entrada_estoque_lote1` FOREIGN KEY (`lote`) REFERENCES `lote` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entrada_estoque_produto1` FOREIGN KEY (`produto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entrada_estoque_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_escola1` FOREIGN KEY (`escola`) REFERENCES `escola` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_prato_dia1` FOREIGN KEY (`alimento_diario`) REFERENCES `alimeto_diario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_produto1` FOREIGN KEY (`produto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_categoria1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produto_codigo_barra1` FOREIGN KEY (`codigo_barra`) REFERENCES `codigo_barra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `saida_caixa`
--
ALTER TABLE `saida_caixa`
  ADD CONSTRAINT `fk_saida_conta_conta1` FOREIGN KEY (`saida_caixa`) REFERENCES `entrada_caixa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_saida_conta_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `saida_estoque`
--
ALTER TABLE `saida_estoque`
  ADD CONSTRAINT `fk_saida_estoque_produto1` FOREIGN KEY (`produto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_saida_estoque_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_nivel_usuario1` FOREIGN KEY (`nivel_usuario`) REFERENCES `nivel_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `fk_item_venda_conta1` FOREIGN KEY (`entrada_caixa`) REFERENCES `entrada_caixa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_venda_prato_dia1` FOREIGN KEY (`prato_dia`) REFERENCES `alimeto_diario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_venda_produto1` FOREIGN KEY (`produto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venda_cliente1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venda_escola1` FOREIGN KEY (`escola`) REFERENCES `escola` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
