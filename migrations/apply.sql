CREATE DATABASE webjump;

USE webjump

CREATE TABLE `webjump`.`produtos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NOT NULL,
  `sku` VARCHAR(20),
  `preco` FLOAT(9,2) UNSIGNED NOT NULL DEFAULT 0,
  `descricao` TEXT,
  `quantidade` INT UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
);

CREATE TABLE `webjump`.`categorias` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `webjump`.`produto_categoria` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `produto_id` INT UNSIGNED NOT NULL,
  `categoria_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
);

ALTER TABLE `webjump`.`produto_categoria` ADD CONSTRAINT `fk_produto_id` FOREIGN KEY ( `produto_id` ) REFERENCES `produtos` (`id`);
ALTER TABLE `webjump`.`produto_categoria` ADD CONSTRAINT `fk_categoria_id` FOREIGN KEY ( `categoria_id` ) REFERENCES `categorias` (`id`);
