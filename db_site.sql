-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Nov-2024 às 23:44
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_site`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_comentarios`
--

CREATE TABLE `tb_comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_postagem` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `data_comentario` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_comentarios`
--

INSERT INTO `tb_comentarios` (`id_comentario`, `id_postagem`, `id_user`, `comentario`, `data_comentario`) VALUES
(1, 2, 2, 'Vai bem ', '2024-11-13 00:14:42'),
(2, 1, 2, 'teste', '2024-11-13 00:14:57'),
(3, 3, 1, 'Olá', '2024-11-13 00:29:36'),
(4, 5, 1, 'bem', '2024-11-13 11:19:07'),
(5, 4, 1, 'bem e tu?', '2024-11-13 11:36:03'),
(6, 1, 1, 'Vai bem ', '2024-11-25 17:07:39'),
(7, 2, 1, 'OLA', '2024-11-25 17:07:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_likes`
--

CREATE TABLE `tb_likes` (
  `id_like` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_postagem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_likes`
--

INSERT INTO `tb_likes` (`id_like`, `id_user`, `id_postagem`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(10, 1, 4),
(11, 1, 5),
(13, 1, 6),
(9, 1, 7),
(8, 1, 8),
(12, 1, 10),
(4, 2, 1),
(6, 2, 2),
(5, 2, 5),
(7, 2, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_postagens`
--

CREATE TABLE `tb_postagens` (
  `id_postagem` int(5) NOT NULL,
  `postagem` varchar(300) NOT NULL,
  `id_user` int(5) NOT NULL,
  `gostos` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_postagens`
--

INSERT INTO `tb_postagens` (`id_postagem`, `postagem`, `id_user`, `gostos`) VALUES
(1, 'Teste', 1, 8),
(2, 'Como esta a correr o vosso dia ', 1, 2),
(3, 'ola', 3, 1),
(4, 'ola como estão ', 1, 1),
(5, 'Ola como estão vocês ', 1, 2),
(6, 'Teste das imagens', 1, 1),
(7, 'Olá a todos.', 4, 1),
(8, 'Teste se esta a funcionar', 1, 1),
(10, 'Olá a todos! Tudo bem?', 2, 2),
(11, 'Teste', 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(5) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `dica` varchar(60) NOT NULL,
  `perfil` varchar(60) NOT NULL,
  `capa` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nome`, `email`, `senha`, `dica`, `perfil`, `capa`) VALUES
(1, 'Rafael Pinto', 'adm@gmail.com', '123', 'numeros', '00017.png', '00122.png'),
(2, 'Rui', 'rui@gmail.com', 'rui', 'nomeros', 'usuario.png', '00068.png'),
(3, 'Tiago', 'tiago@gmail.com', 'tiago', 'nome', '00268.png', '00126.png'),
(4, 'Tone', 'tone@gmail.com', 'tone', 'nome', '00177.png', '00082.png');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_comentarios`
--
ALTER TABLE `tb_comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_postagem` (`id_postagem`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `tb_likes`
--
ALTER TABLE `tb_likes`
  ADD PRIMARY KEY (`id_like`),
  ADD UNIQUE KEY `id_user` (`id_user`,`id_postagem`),
  ADD KEY `id_postagem` (`id_postagem`);

--
-- Índices para tabela `tb_postagens`
--
ALTER TABLE `tb_postagens`
  ADD PRIMARY KEY (`id_postagem`),
  ADD KEY `fk_id_user` (`id_user`);

--
-- Índices para tabela `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_comentarios`
--
ALTER TABLE `tb_comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_likes`
--
ALTER TABLE `tb_likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tb_postagens`
--
ALTER TABLE `tb_postagens`
  MODIFY `id_postagem` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_comentarios`
--
ALTER TABLE `tb_comentarios`
  ADD CONSTRAINT `tb_comentarios_ibfk_1` FOREIGN KEY (`id_postagem`) REFERENCES `tb_postagens` (`id_postagem`),
  ADD CONSTRAINT `tb_comentarios_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Limitadores para a tabela `tb_likes`
--
ALTER TABLE `tb_likes`
  ADD CONSTRAINT `tb_likes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `tb_likes_ibfk_2` FOREIGN KEY (`id_postagem`) REFERENCES `tb_postagens` (`id_postagem`);

--
-- Limitadores para a tabela `tb_postagens`
--
ALTER TABLE `tb_postagens`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;