-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Maio-2023 às 17:25
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_estoque`
--
CREATE DATABASE IF NOT EXISTS `sistema_estoque` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sistema_estoque`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `descricao` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `codigo_barra`
--

CREATE TABLE `codigo_barra` (
  `id` int(11) NOT NULL,
  `cod` varchar(200) NOT NULL,
  `categoria` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

CREATE TABLE `compra` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(225) NOT NULL,
  `preco` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `qtd` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `fatura` int(11) NOT NULL,
  `fornecedor` int(10) UNSIGNED NOT NULL,
  `usuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada_caixa`
--

CREATE TABLE `entrada_caixa` (
  `id` int(10) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `valor_pago` int(11) NOT NULL,
  `troco` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario` int(10) UNSIGNED NOT NULL,
  `forma_pagamento` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada_estoque`
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
-- Estrutura da tabela `escola`
--

CREATE TABLE `escola` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(225) NOT NULL,
  `numero` int(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `recover_pass` varchar(220) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `imagem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `faturas_compras`
--

CREATE TABLE `faturas_compras` (
  `id` int(11) NOT NULL,
  `path` varchar(300) NOT NULL,
  `total` int(11) NOT NULL,
  `fornecedor` int(10) UNSIGNED NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
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
-- Estrutura da tabela `lote`
--

CREATE TABLE `lote` (
  `id` int(11) NOT NULL,
  `lote` varchar(100) NOT NULL,
  `data_exp` varchar(100) NOT NULL,
  `data_prod` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `nivel_usuario`
--

CREATE TABLE `nivel_usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nivel` tinyint(4) NOT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `id` int(10) UNSIGNED NOT NULL,
  `produto` int(10) UNSIGNED DEFAULT NULL,
  `refeicoes` int(10) UNSIGNED DEFAULT NULL,
  `escola` int(10) UNSIGNED NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1','2') NOT NULL,
  `preco` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  `notify` enum('ON','OFF') NOT NULL DEFAULT 'OFF'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
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
-- Estrutura da tabela `refeicoes`
--

CREATE TABLE `refeicoes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(45) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `preco` decimal(6,2) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `saida_caixa`
--

CREATE TABLE `saida_caixa` (
  `id` int(10) UNSIGNED NOT NULL,
  `valor` decimal(5,2) NOT NULL,
  `voltou` enum('YES','NOT') NOT NULL DEFAULT 'NOT',
  `justificativa` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `saida_estoque`
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
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(225) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `recover_pass` varchar(220) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `nivel_usuario` int(10) UNSIGNED NOT NULL,
  `imagem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `recover_pass`, `create_at`, `update_at`, `nivel_usuario`, `imagem`) VALUES
(1, 'Clever', 'clevervictor03@gmail.com', '$2y$10$56y26MCck6JSQJg3npze3umZBf96iP01ovJKqbpRdWOBFzRBcpu3m', NULL, '2023-01-05 23:36:47', '2023-01-05 23:36:47', 1, 'uploads\\Users\\clevervictor03@gmail.com\\167579835_177761310839645_3211802789231516836_n.jpg'),
(2, 'Sokito', 'victorlouren698@gmail.com', '$2y$10$9O4HpB/MAJo40KTLTDDDq.rvHWZUVH/scnrMPKSJJy6t7WUHqZBz.', NULL, '2023-04-04 19:18:51', '2023-04-04 19:18:51', 2, 'uploads\\Users\\victorlouren698@gmail.com\\Nkosi.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(10) UNSIGNED NOT NULL,
  `qtd` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `produto` int(10) UNSIGNED DEFAULT NULL,
  `entrada_caixa` int(10) UNSIGNED NOT NULL,
  `refeicoes` int(10) UNSIGNED DEFAULT NULL,
  `escola` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `codigo_barra`
--
ALTER TABLE `codigo_barra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_codigo_barra_categoria1` (`categoria`);

--
-- Índices para tabela `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_compra_fornecedor1` (`fornecedor`),
  ADD KEY `fk_compra_usuario1` (`usuario`),
  ADD KEY `fk_compra_fatura_compra1` (`fatura`);

--
-- Índices para tabela `entrada_caixa`
--
ALTER TABLE `entrada_caixa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_conta_usuario1` (`usuario`);

--
-- Índices para tabela `entrada_estoque`
--
ALTER TABLE `entrada_estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entrada_estoque_produto1` (`produto`),
  ADD KEY `fk_entrada_estoque_usuario1` (`usuario`),
  ADD KEY `fk_entrada_estoque_lote1` (`lote`);

--
-- Índices para tabela `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `faturas_compras`
--
ALTER TABLE `faturas_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fornecedor` (`fornecedor`);

--
-- Índices para tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `nivel_usuario`
--
ALTER TABLE `nivel_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedido_produto1` (`produto`),
  ADD KEY `fk_pedido_refeicoes` (`refeicoes`),
  ADD KEY `fk_pedido_escola1` (`escola`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produto_categoria1` (`categoria`),
  ADD KEY `fk_produto_codigo_barra1` (`codigo_barra`);

--
-- Índices para tabela `refeicoes`
--
ALTER TABLE `refeicoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `saida_caixa`
--
ALTER TABLE `saida_caixa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_saida_conta_usuario1` (`usuario`);

--
-- Índices para tabela `saida_estoque`
--
ALTER TABLE `saida_estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_saida_estoque_usuario1` (`usuario`),
  ADD KEY `fk_saida_estoque_produto1` (`produto`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_nivel_usuario1` (`nivel_usuario`);

--
-- Índices para tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_item_venda_produto1` (`produto`),
  ADD KEY `fk_item_venda_conta1` (`entrada_caixa`),
  ADD KEY `fk_item_venda_refeicoes1` (`refeicoes`),
  ADD KEY `fk_venda_escola1` (`escola`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `codigo_barra`
--
ALTER TABLE `codigo_barra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `entrada_caixa`
--
ALTER TABLE `entrada_caixa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `entrada_estoque`
--
ALTER TABLE `entrada_estoque`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `escola`
--
ALTER TABLE `escola`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `faturas_compras`
--
ALTER TABLE `faturas_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lote`
--
ALTER TABLE `lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `nivel_usuario`
--
ALTER TABLE `nivel_usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `refeicoes`
--
ALTER TABLE `refeicoes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `saida_caixa`
--
ALTER TABLE `saida_caixa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `saida_estoque`
--
ALTER TABLE `saida_estoque`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `codigo_barra`
--
ALTER TABLE `codigo_barra`
  ADD CONSTRAINT `fk_codigo_barra_categoria1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_fatura_compra1` FOREIGN KEY (`fatura`) REFERENCES `faturas_compras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_compra_fornecedor1` FOREIGN KEY (`fornecedor`) REFERENCES `fornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `entrada_caixa`
--
ALTER TABLE `entrada_caixa`
  ADD CONSTRAINT `fk_conta_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `entrada_estoque`
--
ALTER TABLE `entrada_estoque`
  ADD CONSTRAINT `fk_entrada_estoque_lote1` FOREIGN KEY (`lote`) REFERENCES `lote` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_entrada_estoque_produto1` FOREIGN KEY (`produto`) REFERENCES `produto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_entrada_estoque_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `faturas_compras`
--
ALTER TABLE `faturas_compras`
  ADD CONSTRAINT `fk_fornecedor` FOREIGN KEY (`fornecedor`) REFERENCES `fornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_escola1` FOREIGN KEY (`escola`) REFERENCES `escola` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_produto1` FOREIGN KEY (`produto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_refeicoes` FOREIGN KEY (`refeicoes`) REFERENCES `refeicoes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_categoria1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produto_codigo_barra1` FOREIGN KEY (`codigo_barra`) REFERENCES `codigo_barra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `saida_caixa`
--
ALTER TABLE `saida_caixa`
  ADD CONSTRAINT `fk_saida_conta_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `saida_estoque`
--
ALTER TABLE `saida_estoque`
  ADD CONSTRAINT `fk_saida_estoque_produto1` FOREIGN KEY (`produto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_saida_estoque_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_nivel_usuario1` FOREIGN KEY (`nivel_usuario`) REFERENCES `nivel_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `fk_item_venda_conta1` FOREIGN KEY (`entrada_caixa`) REFERENCES `entrada_caixa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_item_venda_produto1` FOREIGN KEY (`produto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_venda_refeicoes1` FOREIGN KEY (`refeicoes`) REFERENCES `refeicoes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venda_escola1` FOREIGN KEY (`escola`) REFERENCES `escola` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
