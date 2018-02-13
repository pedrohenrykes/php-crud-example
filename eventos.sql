USE mysql;

-- Banco de dados de eventos
DROP DATABASE IF EXISTS eventos;
CREATE DATABASE eventos;
USE eventos;

CREATE TABLE `locais` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `eventos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `local_id` bigint(20) UNSIGNED NOT NULL,
  `edicao` int(11) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(local_id) REFERENCES locais(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `programacoes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `evento_id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text,
  `data_evento` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fim` time DEFAULT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(evento_id) REFERENCES eventos(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
