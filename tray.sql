-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Ago-2021 às 02:05
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tray`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `caracteristica`
--

CREATE TABLE `caracteristica` (
  `idcaracteristica` int(11) NOT NULL,
  `caracteristica` varchar(50) NOT NULL,
  `codigocaracteristica` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `caracteristicadetalhe`
--

CREATE TABLE `caracteristicadetalhe` (
  `idcaracteristicadetalhe` int(11) NOT NULL,
  `caracteristicadetalhe` varchar(100) NOT NULL,
  `idcaracteristica` int(11) NOT NULL,
  `codigocaracteristicadetalhe` varchar(100) NOT NULL,
  `codigocaracteristicapai` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `caracteristicaproduto`
--

CREATE TABLE `caracteristicaproduto` (
  `idcaracteristicaproduto` int(11) NOT NULL,
  `idproduto` varchar(80) DEFAULT NULL,
  `caracteristicapai` varchar(80) DEFAULT NULL,
  `caracteristicafilho` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `categoria` varchar(200) NOT NULL,
  `codigocategoria` varchar(50) DEFAULT NULL,
  `codigocategoriapai` varchar(50) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `descricaocurta` varchar(4000) DEFAULT NULL,
  `datestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `cliente` varchar(200) NOT NULL,
  `codigocliente` varchar(200) DEFAULT NULL,
  `cnpj` varchar(50) DEFAULT NULL,
  `datacriacao` datetime DEFAULT NULL,
  `dataregistro` date DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `datanascimento` date DEFAULT NULL,
  `genero` tinyint(4) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `desconto` decimal(10,2) DEFAULT NULL,
  `ultimavisita` date DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `uf` varchar(50) DEFAULT NULL,
  `newsletter` tinyint(4) DEFAULT NULL,
  `datamodificacao` date DEFAULT NULL,
  `datestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientedetalhe`
--

CREATE TABLE `clientedetalhe` (
  `idclientedetalhe` int(11) NOT NULL,
  `codigocliente` varchar(200) DEFAULT NULL,
  `cnpj` varchar(30) DEFAULT NULL,
  `newsletter` varchar(30) DEFAULT NULL,
  `terms` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `id` varchar(5) DEFAULT NULL,
  `created` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `namecliente` varchar(50) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `rg` varchar(30) DEFAULT NULL,
  `cpf` varchar(30) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `cellphone` varchar(30) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` varchar(5) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `total_orders` varchar(30) DEFAULT NULL,
  `observation` varchar(200) DEFAULT NULL,
  `typecliente` varchar(30) DEFAULT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `state_inscription` varchar(50) DEFAULT NULL,
  `reseller` varchar(30) DEFAULT NULL,
  `discount` varchar(30) DEFAULT NULL,
  `blocked` varchar(30) DEFAULT NULL,
  `credit_limit` varchar(30) DEFAULT NULL,
  `indicator_id` varchar(30) DEFAULT NULL,
  `profile_customer_id` varchar(30) DEFAULT NULL,
  `last_sending_newsletter` date DEFAULT NULL,
  `last_purchase` date DEFAULT NULL,
  `last_visit` date DEFAULT NULL,
  `last_modification` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `addresscliente` varchar(200) DEFAULT NULL,
  `zip_code` varchar(50) DEFAULT NULL,
  `numbercliente` varchar(30) DEFAULT NULL,
  `complement` varchar(100) DEFAULT NULL,
  `neighborhood` varchar(100) DEFAULT NULL,
  `city` varchar(80) DEFAULT NULL,
  `statecliente` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `modified` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `dtmodification` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `depara`
--

CREATE TABLE `depara` (
  `iddepara` int(11) NOT NULL,
  `depara` varchar(200) NOT NULL,
  `valorantigo` varchar(500) NOT NULL,
  `valornovo` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `depara`
--

INSERT INTO `depara` (`iddepara`, `depara`, `valorantigo`, `valornovo`) VALUES
(1, 'traystatus', 'CANCELADO', '2'),
(2, 'traystatus', 'ENVIADO', '3'),
(3, 'traystatus', 'FINALIZADO', '4'),
(4, 'traystatus', 'A ENVIAR YAPAY', '3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `idmarca` int(11) NOT NULL,
  `marca` varchar(200) NOT NULL,
  `codigomarca` int(11) NOT NULL,
  `slug` varchar(60) DEFAULT NULL,
  `datestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`idmarca`, `marca`, `codigomarca`, `slug`, `datestamp`) VALUES
(1, 'Antonio Bernardo', 1, 'antonio-bernardo', '2020-07-22 19:05:43'),
(2, 'H.Stern', 3, 'hstern', '2020-07-22 19:05:43'),
(3, 'Vivara', 7, 'vivara', '2020-07-22 19:05:44'),
(4, 'teste2', 9, 'teste2', '2020-07-22 19:05:45'),
(5, 'Cartier', 11, 'cartier', '2020-07-22 19:05:45'),
(6, 'Tag Heuer', 13, 'tag-heuer', '2020-07-22 19:05:46'),
(7, 'Montblanc', 15, 'montblanc', '2020-07-22 19:05:46'),
(8, 'Omega', 17, 'omega', '2020-07-22 19:05:47'),
(9, 'Breitling', 19, 'breitling', '2020-07-22 19:05:48'),
(10, 'Rolex', 21, 'rolex', '2020-07-22 19:05:48'),
(11, 'Chopard', 25, 'chopard', '2020-07-22 19:05:49'),
(12, 'Mühle Glashütte', 27, 'muehle-glashuette', '2020-07-22 19:05:49'),
(13, 'Movado', 29, 'movado', '2020-07-22 19:05:50'),
(14, 'Natan', 31, 'natan', '2020-07-22 19:05:51'),
(15, 'Jack Vartanian', 33, 'jack-vartanian', '2020-07-22 19:05:51'),
(16, 'Jaeger-Lecoultre', 35, 'jaeger-lecoultre', '2020-07-22 19:05:52'),
(17, 'Patek Philippe', 37, 'patek-philippe', '2020-07-22 19:05:53'),
(18, 'Panerai', 43, 'panerai', '2020-07-22 19:05:54'),
(19, 'Longines', 45, 'longines', '2020-07-22 19:05:54'),
(20, 'Baume & Mercier', 47, 'baume-mercier', '2020-07-22 19:05:55'),
(21, 'Ana Rocha & Appolinario', 49, 'ana-rocha-eappolinario', '2020-07-22 19:05:55'),
(22, 'Ara Vartanian', 51, 'ara-vartanian', '2020-07-22 19:05:56'),
(23, 'Bvlgari', 53, 'bvlgari', '2020-07-22 19:05:57'),
(24, 'Gucci', 61, 'gucci', '2020-07-22 19:05:57'),
(25, 'Mido', 69, 'mido', '2020-07-22 19:05:58'),
(26, 'Oris', 71, 'oris', '2020-07-22 19:05:59'),
(27, 'Piaget', 73, 'piaget', '2020-07-22 19:05:59'),
(28, 'Rado', 75, 'rado', '2020-07-22 19:06:00'),
(29, 'Dior', 77, 'dior', '2020-07-22 19:06:01'),
(30, 'Eloga', 79, 'eloga', '2020-07-22 19:06:02'),
(31, 'Hamilton', 81, 'hamilton', '2020-07-22 19:17:47'),
(32, 'Tiffany & Co', 83, 'tiffany-co', '2020-07-22 19:17:48'),
(33, 'IWC', 85, 'iwc', '2020-07-22 19:17:48'),
(34, 'Carla Amorim', 87, 'carla-amorim', '2020-07-22 19:17:49'),
(35, 'Ebel', 89, 'ebel', '2020-07-22 19:17:49'),
(36, 'Boucheron', 91, 'boucheron', '2020-07-22 19:17:50'),
(37, 'Tissot', 95, 'tissot', '2020-07-22 19:17:51'),
(38, 'Victorinox', 97, 'victorinox', '2020-07-22 19:17:51'),
(39, 'Versace', 107, 'versace', '2020-08-19 10:23:42'),
(40, 'Julio Okubo', 109, 'julio-okubo', '2020-08-19 10:23:43'),
(41, '1', 111, '1', '2020-08-19 10:23:43'),
(42, 'Waterman', 115, 'waterman', '2020-08-19 10:23:44'),
(43, 'Montegrappa', 117, 'montegrappa', '2020-08-19 10:23:45'),
(44, 'Louis Vuitton', 121, 'louis-vuitton', '2020-08-19 10:23:45'),
(45, 'Dupont', 125, 'dupont', '2020-08-19 10:23:46'),
(46, 'Aurora', 127, 'aurora', '2020-08-19 10:23:47'),
(47, 'Parker', 129, 'parker', '2020-08-19 10:23:48'),
(48, 'Sheafer', 131, 'sheafer', '2020-08-19 10:23:48'),
(49, 'Hublot', 133, 'hublot', '2020-08-20 12:58:51'),
(50, 'Bulgari', 135, 'bulgari', '2020-08-24 12:43:49'),
(51, 'Teste', 137, 'teste', '2020-09-14 13:27:01'),
(52, 'Não tem', 149, 'nao-tem', '2020-09-14 13:27:01'),
(53, 'Monte Carlo', 159, 'monte-carlo', '2020-09-14 13:27:02'),
(54, 'Pandora', 161, 'pandora', '2020-09-14 13:27:02'),
(55, 'Tiffany', 163, 'tiffany', '2020-09-14 13:27:03'),
(56, 'Guerreiro', 165, 'guerreiro', '2020-09-14 13:27:04'),
(57, 'Chanel', 167, 'chanel', '2020-09-14 13:27:04'),
(58, 'Silvia Fumanovich', 169, 'silvia-fumanovich', '2020-09-14 13:27:05'),
(59, 'Mauboussin', 171, 'mauboussin', '2021-02-21 18:02:26'),
(60, 'Bell & Ross', 173, 'bell-ross', '2021-02-21 18:02:26'),
(61, 'Ana Khouri', 175, 'ana-khouri', '2021-02-21 18:02:26'),
(62, 'Girard Perregaux', 177, 'girard-perregaux', '2021-02-21 18:02:26'),
(63, 'Vacheron Constantin', 179, 'vacheron-constantin', '2021-02-21 18:02:26'),
(64, 'H,Stern', 181, 'h-stern-', '2021-02-21 18:02:26'),
(65, 'Jaquet', 183, 'jaquet', '2021-02-21 18:02:26'),
(66, 'Graham', 185, 'graham', '2021-02-21 18:02:26'),
(67, 'Bulova', 187, 'bulova', '2021-02-21 18:02:26'),
(68, 'Raymond Weil', 189, 'raymond-weil', '2021-02-21 18:02:26'),
(69, 'Porsche', 191, 'porsche', '2021-02-21 18:02:26'),
(70, 'Frederique Constant', 193, 'frederique-constant', '2021-02-21 18:02:26'),
(71, 'Hugo Boss', 195, 'hugo-boss', '2021-02-21 18:02:26'),
(72, 'Maurice Lacroix', 197, 'maurice-lacroix', '2021-02-21 18:02:26'),
(73, 'Christian Dior', 199, 'christian-dior', '2021-02-21 18:02:26'),
(74, 'Rigi', 201, 'rigi', '2021-02-21 18:02:26'),
(75, 'Zenith', 207, 'zenith', '2021-02-21 18:02:26'),
(76, 'Alfex', 209, 'alfex', '2021-02-21 18:02:26'),
(77, 'Orit', 211, 'orit', '2021-02-21 18:02:26'),
(78, 'Junia Machado', 213, 'junia-machado', '2021-02-21 18:02:26'),
(79, 'CK Calvin Klein', 215, 'ck-calvin-klein', '2021-02-21 18:02:26'),
(80, 'Amsterdam Sauer', 217, 'amsterdam-sauer', '2021-02-21 18:02:26'),
(81, 'The Graces', 219, 'the-graces', '2021-02-21 18:02:26'),
(82, 'Noa', 221, 'noa', '2021-02-21 18:02:26'),
(83, 'Brenda Vidal', 223, 'brenda-vidal', '2021-02-21 18:02:26'),
(84, 'Dryzun', 225, 'dryzun', '2021-02-21 18:02:26'),
(85, 'Bucherer', 227, 'bucherer', '2021-02-21 18:02:26'),
(86, 'Audemars Piguet', 229, 'audemars-piguet', '2021-02-21 18:02:26'),
(87, 'Citizen', 231, 'citizen', '2021-02-21 18:02:26'),
(88, 'Philip Watch', 233, 'philip-watch', '2021-02-21 18:02:26'),
(89, 'Geneve', 235, 'geneve', '2021-02-21 18:02:26'),
(90, 'Corum', 237, 'corum', '2021-02-21 18:02:26'),
(91, 'Gianni Versace', 239, 'gianni-versace', '2021-07-05 21:49:01'),
(92, 'Technos', 241, 'technos', '2021-07-05 21:49:01'),
(93, 'Amistedan Sauer', 243, 'amistedan-sauer', '2021-07-05 21:49:01'),
(94, 'Fossil', 245, 'fossil', '2021-07-05 21:49:01'),
(95, 'Roberto Cavalli', 247, 'roberto-cavalli', '2021-07-05 21:49:01'),
(96, 'Amstedam Sauer', 249, 'amstedam-sauer', '2021-07-05 21:49:01'),
(97, 'Laco', 251, 'laco', '2021-07-05 21:49:02'),
(98, 'Junghans', 253, 'junghans', '2021-07-05 21:49:02'),
(99, 'Sgvardo', 255, 'sgvardo', '2021-07-05 21:49:02'),
(100, 'Seiko', 257, 'seiko', '2021-07-05 21:49:02'),
(101, 'Robert cart', 259, 'robert-cart', '2021-07-05 21:49:02'),
(102, 'Guess', 261, 'guess', '2021-07-05 21:49:02'),
(103, 'Fendi', 263, 'fendi', '2021-07-05 21:49:02'),
(104, 'Carelle', 265, 'carelle', '2021-07-05 21:49:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` int(11) NOT NULL,
  `codigopedido` varchar(200) NOT NULL,
  `idpedidostatus` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `codigocliente` varchar(200) NOT NULL,
  `valorparcial` decimal(10,2) DEFAULT NULL,
  `taxas` decimal(10,2) DEFAULT NULL,
  `desconto` decimal(10,2) DEFAULT NULL,
  `pontodevenda` varchar(200) DEFAULT NULL,
  `metodoentrega` varchar(200) DEFAULT NULL,
  `valorfrete` decimal(10,2) DEFAULT NULL,
  `dataentrega` date DEFAULT NULL,
  `cupomdesconto` varchar(200) DEFAULT NULL,
  `taxadopagamento` decimal(10,2) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `formapagamento` varchar(200) DEFAULT NULL,
  `codigoenviado` varchar(200) DEFAULT NULL,
  `idsessao` varchar(200) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `datapagamento` date DEFAULT NULL,
  `codigoacesso` varchar(200) NOT NULL,
  `integradorremessa` varchar(200) NOT NULL,
  `datamodificacao` datetime DEFAULT NULL,
  `idcotacao` varchar(200) DEFAULT NULL,
  `dataestimadaentrega` date DEFAULT NULL,
  `codigoexterno` varchar(200) DEFAULT NULL,
  `totalcomissao` decimal(10,2) DEFAULT NULL,
  `rastreavel` varchar(50) DEFAULT NULL,
  `datestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidoproduto`
--

CREATE TABLE `pedidoproduto` (
  `idpedidoproduto` int(11) NOT NULL,
  `idpedido` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `status` varchar(60) DEFAULT NULL,
  `datestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidostatus`
--

CREATE TABLE `pedidostatus` (
  `idpedidostatus` int(11) NOT NULL,
  `pedidostatus` varchar(200) NOT NULL,
  `datestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `idproduto` int(11) NOT NULL,
  `produto` varchar(100) DEFAULT NULL,
  `codigoproduto` varchar(50) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `descricaocurta` varchar(4000) DEFAULT NULL,
  `ean` varchar(200) DEFAULT NULL,
  `datamodificacao` date DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `ncm` varchar(200) DEFAULT NULL,
  `temkit` tinyint(4) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `custo` decimal(10,2) DEFAULT NULL,
  `precopromocional` decimal(10,2) DEFAULT NULL,
  `precodolar` int(11) DEFAULT NULL,
  `iniciopromocao` date DEFAULT NULL,
  `finalpromocao` date DEFAULT NULL,
  `marca` varchar(200) DEFAULT NULL,
  `modelo` varchar(200) DEFAULT NULL,
  `peso` decimal(10,4) DEFAULT NULL,
  `comprimento` decimal(10,4) DEFAULT NULL,
  `largura` decimal(10,4) DEFAULT NULL,
  `altura` decimal(10,2) DEFAULT NULL,
  `pesocubico` decimal(10,2) DEFAULT NULL,
  `estoque` decimal(10,2) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `disponivel` tinyint(4) DEFAULT NULL,
  `disponibilidade` varchar(200) DEFAULT NULL,
  `referencia` varchar(200) DEFAULT NULL,
  `hot` tinyint(4) DEFAULT NULL,
  `lancamento` tinyint(4) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `dtcriacao` timestamp NULL DEFAULT NULL,
  `dataativacao` date DEFAULT NULL,
  `datadesativacao` timestamp NULL DEFAULT NULL,
  `datestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtocategoria`
--

CREATE TABLE `produtocategoria` (
  `idprodutocategoria` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtopedido`
--

CREATE TABLE `produtopedido` (
  `idprodutopedido` int(11) NOT NULL,
  `codigopedido` varchar(50) CHARACTER SET utf8 NOT NULL,
  `codigoproduto` varchar(50) CHARACTER SET utf8 NOT NULL,
  `status` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tray_acesso`
--

CREATE TABLE `tray_acesso` (
  `id` int(11) NOT NULL,
  `consumer_key` varchar(500) DEFAULT NULL,
  `consumer_secret` varchar(500) DEFAULT NULL,
  `code` varchar(500) DEFAULT NULL,
  `refresh_token` varchar(500) DEFAULT NULL,
  `access_token` varchar(500) DEFAULT NULL,
  `url` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tray_acesso`
--

INSERT INTO `tray_acesso` (`id`, `consumer_key`, `consumer_secret`, `code`, `refresh_token`, `access_token`, `url`) VALUES
(1, '1388617810eeb3b36cf2bb5d3beef4667e82c452314aa9dfa7b740600665cb2f', 'f5fcbf9965d6cd7c9123dc264335f01b801c1479f4c7650f8883af335608a701', '7b156fcbbb15a14d71d5213fd4e35987f5b219c60b394b336116855bc24d6641', '2691abc5124838c6c38b5bbc9c8b67150b621c0ed841e5e71a88d5bb2b79bd78', 'APP_ID-1813-13c8a84751a3fbe32a56f6e4b66614f7a889de849641b3368b0953ab10d9eb39', 'https://www.orit.com.br/web_api');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `caracteristica`
--
ALTER TABLE `caracteristica`
  ADD PRIMARY KEY (`idcaracteristica`);

--
-- Índices para tabela `caracteristicadetalhe`
--
ALTER TABLE `caracteristicadetalhe`
  ADD PRIMARY KEY (`idcaracteristicadetalhe`),
  ADD KEY `fk_idcaracteristica` (`idcaracteristica`);

--
-- Índices para tabela `caracteristicaproduto`
--
ALTER TABLE `caracteristicaproduto`
  ADD PRIMARY KEY (`idcaracteristicaproduto`);

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`),
  ADD KEY `codigocategoria` (`codigocategoria`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `codigocliente` (`codigocliente`);

--
-- Índices para tabela `clientedetalhe`
--
ALTER TABLE `clientedetalhe`
  ADD PRIMARY KEY (`idclientedetalhe`);

--
-- Índices para tabela `depara`
--
ALTER TABLE `depara`
  ADD PRIMARY KEY (`iddepara`);

--
-- Índices para tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idmarca`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`);

--
-- Índices para tabela `pedidoproduto`
--
ALTER TABLE `pedidoproduto`
  ADD PRIMARY KEY (`idpedidoproduto`);

--
-- Índices para tabela `pedidostatus`
--
ALTER TABLE `pedidostatus`
  ADD PRIMARY KEY (`idpedidostatus`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idproduto`),
  ADD KEY `codigoproduto` (`codigoproduto`);

--
-- Índices para tabela `produtocategoria`
--
ALTER TABLE `produtocategoria`
  ADD PRIMARY KEY (`idprodutocategoria`);

--
-- Índices para tabela `produtopedido`
--
ALTER TABLE `produtopedido`
  ADD PRIMARY KEY (`idprodutopedido`),
  ADD KEY `fk_pedidos` (`codigopedido`),
  ADD KEY `fk_produto` (`codigoproduto`);

--
-- Índices para tabela `tray_acesso`
--
ALTER TABLE `tray_acesso`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `caracteristica`
--
ALTER TABLE `caracteristica`
  MODIFY `idcaracteristica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `caracteristicadetalhe`
--
ALTER TABLE `caracteristicadetalhe`
  MODIFY `idcaracteristicadetalhe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT de tabela `caracteristicaproduto`
--
ALTER TABLE `caracteristicaproduto`
  MODIFY `idcaracteristicaproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35842;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=791;

--
-- AUTO_INCREMENT de tabela `clientedetalhe`
--
ALTER TABLE `clientedetalhe`
  MODIFY `idclientedetalhe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2380;

--
-- AUTO_INCREMENT de tabela `depara`
--
ALTER TABLE `depara`
  MODIFY `iddepara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `idmarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5310;

--
-- AUTO_INCREMENT de tabela `pedidoproduto`
--
ALTER TABLE `pedidoproduto`
  MODIFY `idpedidoproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6418;

--
-- AUTO_INCREMENT de tabela `pedidostatus`
--
ALTER TABLE `pedidostatus`
  MODIFY `idpedidostatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `idproduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4312;

--
-- AUTO_INCREMENT de tabela `produtocategoria`
--
ALTER TABLE `produtocategoria`
  MODIFY `idprodutocategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12577;

--
-- AUTO_INCREMENT de tabela `produtopedido`
--
ALTER TABLE `produtopedido`
  MODIFY `idprodutopedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1955;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
