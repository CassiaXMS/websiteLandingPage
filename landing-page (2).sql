CREATE TABLE `cadastro` (
  `id_user` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci,
  `sobrenome` varchar(50) COLLATE utf8mb4_unicode_ci,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci,
  `senha` varchar(100) COLLATE utf8mb4_unicode_ci,
  `celular` varchar(20) COLLATE utf8mb4_unicode_ci
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `login` (
  `id_login` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `login`
  ADD CONSTRAINT `login_cadastro` FOREIGN KEY (`id_user`) REFERENCES `cadastro` (`id_user`);
