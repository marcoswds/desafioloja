CREATE DATABASE loja;

USE loja;

CREATE TABLE `produto` (
	`id_produto` INT(9) NOT NULL AUTO_INCREMENT,
	`cd_produto` VARCHAR(20) NOT NULL,
	`ds_produto` VARCHAR(255) NULL DEFAULT '',
	`vl_preco` DOUBLE(9,2) NULL DEFAULT '0.00',
	PRIMARY KEY (`id_produto`),
	UNIQUE INDEX `cd_produto` (`cd_produto`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=5
;

CREATE TABLE `documento` (
	`id_documento` INT(11) NOT NULL AUTO_INCREMENT,
	`vl_total` DOUBLE(9,2) NOT NULL DEFAULT '0.00',
	`sn_confirmado` TINYINT(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id_documento`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;

CREATE TABLE `documento_item` (
	`id_documento_item` INT(11) NOT NULL AUTO_INCREMENT,
	`id_documento` INT(11) NOT NULL,
	`id_produto` INT(11) NOT NULL,
	PRIMARY KEY (`id_documento_item`),
	INDEX `fk_id_produto` (`id_produto`),
	INDEX `fk_id_documento` (`id_documento`),
	CONSTRAINT `fk_id_documento` FOREIGN KEY (`id_documento`) REFERENCES `documento` (`id_documento`),
	CONSTRAINT `fk_id_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;