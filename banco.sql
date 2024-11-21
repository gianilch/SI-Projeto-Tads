CREATE SCHEMA IF NOT EXISTS `tads` DEFAULT CHARACTER SET utf8 ;
USE `tads` ;

CREATE TABLE IF NOT EXISTS `tads`.`fornecedor` (
  `id_fornecedor` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cnpj` VARCHAR(15) NULL,
  PRIMARY KEY (`id_fornecedor`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tads`.`produto` (
  `id_produto` INT NOT NULL AUTO_INCREMENT,
  `id_fornecedor` INT NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `valor` REAL NOT NULL,
  `codigo_barras` VARCHAR(15) NULL,
  `categoria` VARCHAR(45) NULL,
  `quantidade_estoque` INT NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `foto` VARCHAR(255) NULL,
  PRIMARY KEY (`id_produto`, `id_fornecedor`),
  INDEX `fk_produto_fornecedor1_idx` (`id_fornecedor` ASC) ,
  CONSTRAINT `fk_produto_fornecedor1`
    FOREIGN KEY (`id_fornecedor`)
    REFERENCES `tads`.`fornecedor` (`id_fornecedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tads`.`cliente` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `cpf` VARCHAR(11) NOT NULL,
  `nome` VARCHAR(255) NULL,
  `telefone` VARCHAR(13) NULL,
  `score` INT NULL,
  `data_nascimento` DATE NULL,
  `limite_credito` REAL NULL,
  `email` VARCHAR(255) NULL,
  `recebe_whatsapp` TINYINT NULL,
  `recebe_email` TINYINT NULL,
  `recebe_sms` TINYINT NULL,
  PRIMARY KEY (`id_cliente`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tads`.`endereco` (
  `id_endereco` INT NOT NULL AUTO_INCREMENT,
  `cliente_id_cliente` INT NOT NULL,
  `fornecedor_id_fornecedor` INT NOT NULL,
  `uf` VARCHAR(2) NULL,
  `cidade` VARCHAR(100) NULL,
  `logradouro` VARCHAR(45) NULL,
  `bairro` VARCHAR(45) NULL,
  `numero` VARCHAR(45) NULL,
  `cep` VARCHAR(45) NULL,
  `complemento` VARCHAR(45) NULL,
  PRIMARY KEY (`id_endereco`),
  INDEX `fk_endereco_cliente_idx` (`cliente_id_cliente` ASC) ,
  INDEX `fk_endereco_fornecedor1_idx` (`fornecedor_id_fornecedor` ASC) )
ENGINE = MyISAM;

CREATE TABLE IF NOT EXISTS `tads`.`funcionario` (
  `id_funcionario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `salario` REAL NULL,
  `meta` REAL NULL,
  `cargo` VARCHAR(100) NULL,
  `comissao` REAL NULL,
  PRIMARY KEY (`id_funcionario`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tads`.`forma_pagamento` (
  `id_pagamento` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `aceita_parcelamento` TINYINT NOT NULL,
  `prazo_parcela` INT NULL,
  `juros` REAL NULL,
  PRIMARY KEY (`id_pagamento`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tads`.`Venda` (
  `id_venda` INT NOT NULL AUTO_INCREMENT,
  `id_cliente` INT NOT NULL,
  `id_funcionario` INT NOT NULL,
  `id_pagamento` INT NOT NULL,
  `valor` REAL NULL,
  `data` DATE NULL,
  PRIMARY KEY (`id_venda`, `id_cliente`, `id_funcionario`, `id_pagamento`),
  INDEX `fk_Venda_funcionario1_idx` (`id_funcionario` ASC) ,
  INDEX `fk_Venda_cliente1_idx` (`id_cliente` ASC) ,
  INDEX `fk_Venda_formas_pagamento1_idx` (`id_pagamento` ASC) ,
  CONSTRAINT `fk_Venda_funcionario1`
    FOREIGN KEY (`id_funcionario`)
    REFERENCES `tads`.`funcionario` (`id_funcionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Venda_cliente1`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `tads`.`cliente` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Venda_formas_pagamento1`
    FOREIGN KEY (`id_pagamento`)
    REFERENCES `tads`.`forma_pagamento` (`id_pagamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tads`.`itens_venda` (
  `id_itens_venda` INT NOT NULL AUTO_INCREMENT,
  `id_produto` INT NOT NULL,
  `id_venda` INT NOT NULL,
  `id_funcionario` INT NOT NULL,
  `desconto_item` REAL NULL,
  PRIMARY KEY (`id_itens_venda`),
  INDEX `fk_produto_has_Venda_Venda1_idx` (`id_venda`),
  INDEX `fk_produto_has_Venda_produto1_idx` (`id_produto`),
  CONSTRAINT `fk_produto_has_Venda_produto1`
    FOREIGN KEY (`id_produto`)
    REFERENCES `tads`.`produto` (`id_produto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_itens_venda_funcionario1`
    FOREIGN KEY (`id_funcionario`)
    REFERENCES `tads`.`funcionario` (`id_funcionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_has_Venda_Venda1`
    FOREIGN KEY (`id_venda`)
    REFERENCES `tads`.`Venda` (`id_venda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `tads`.`estoque` (
  `id_estoque` INT NOT NULL AUTO_INCREMENT,
  `id_produto` INT NOT NULL,
  `quantidade` VARCHAR(45) NOT NULL,
  `tipo_movimentacao` VARCHAR(45) NOT NULL,
  `data_movimentacao` DATE NOT NULL,
  PRIMARY KEY (`id_estoque`, `id_produto`),
  INDEX `fk_estoque_produto1_idx` (`id_produto` ASC) ,
  CONSTRAINT `fk_estoque_produto1`
    FOREIGN KEY (`id_produto`)
    REFERENCES `tads`.`produto` (`id_produto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tads`.`parcela` (
  `id_parcela` INT NOT NULL AUTO_INCREMENT,
  `id_venda` INT NOT NULL,
  `id_cliente` INT NOT NULL,
  `id_vendedor` INT NOT NULL,
  `id_forma_pagamento` INT NOT NULL,
  `valor_parcela` REAL NOT NULL,
  `data_vencimento` DATE NOT NULL,
  `data_pagamento` DATE NULL,
  `numero_parcela` INT NOT NULL,
  `confirma_pagamento` TINYINT NULL,
  PRIMARY KEY (`id_parcela`, `id_venda`, `id_cliente`, `id_vendedor`, `id_forma_pagamento`),
  INDEX `fk_parcela_Venda1_idx` (`id_venda` ASC, `id_cliente` ASC, `id_vendedor` ASC, `id_forma_pagamento` ASC) ,
  CONSTRAINT `fk_parcela_Venda1`
    FOREIGN KEY (`id_venda` , `id_cliente` , `id_vendedor` , `id_forma_pagamento`)
    REFERENCES `tads`.`Venda` (`id_venda` , `id_cliente` , `id_funcionario` , `id_pagamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tads`.`status_chamado` (
  `id_status_chamado` INT NOT NULL AUTO_INCREMENT,
  `situacao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_status_chamado`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tads`.`satisfacao_feedback` (
  `id_satisfacao` INT NOT NULL AUTO_INCREMENT,
  `nota_satisfacao` INT NULL,
  `feedback_atendimento` VARCHAR(255) NULL,
  PRIMARY KEY (`id_satisfacao`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tads`.`chamado` (
  `id_chamado` INT NOT NULL AUTO_INCREMENT,
  `id_venda` INT NOT NULL,
  `id_cliente` INT NOT NULL,
  `id_funcionario` INT NOT NULL,
  `id_pagamento` INT NOT NULL,
  `id_status_chamado` INT NOT NULL,
  `id_satisfacao` INT NOT NULL,
  `descricao` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`id_chamado`, `id_venda`, `id_cliente`, `id_funcionario`, `id_pagamento`, `id_status_chamado`, `id_satisfacao`),
  INDEX `fk_chamado_Venda1_idx` (`id_venda` ASC, `id_cliente` ASC, `id_funcionario` ASC, `id_pagamento` ASC) ,
  INDEX `fk_chamado_status_chamado1_idx` (`id_status_chamado` ASC) ,
  INDEX `fk_chamado_satisfacao_feedback1_idx` (`id_satisfacao` ASC) ,
  CONSTRAINT `fk_chamado_Venda1`
    FOREIGN KEY (`id_venda` , `id_cliente` , `id_funcionario` , `id_pagamento`)
    REFERENCES `tads`.`Venda` (`id_venda` , `id_cliente` , `id_funcionario` , `id_pagamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamado_status_chamado1`
    FOREIGN KEY (`id_status_chamado`)
    REFERENCES `tads`.`status_chamado` (`id_status_chamado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamado_satisfacao_feedback1`
    FOREIGN KEY (`id_satisfacao`)
    REFERENCES `tads`.`satisfacao_feedback` (`id_satisfacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tads`.`conta_pagar` (
  `id_parcela` INT NOT NULL AUTO_INCREMENT,
  `id_fornecedor` INT NOT NULL,
  `valor_parcela` REAL NOT NULL,
  `data_vencimento` DATE NOT NULL,
  `data_pagamento` DATE NULL,
  `numero_parcela` INT NOT NULL,
  `confirma_pagamento` TINYINT NULL,
  PRIMARY KEY (`id_parcela`, `id_fornecedor`),
  INDEX `fk_conta_pagar_fornecedor1_idx` (`id_fornecedor` ASC) ,
  CONSTRAINT `fk_conta_pagar_fornecedor1`
    FOREIGN KEY (`id_fornecedor`)
    REFERENCES `tads`.`fornecedor` (`id_fornecedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tads`.`analise_produto` (
  `id_analise` INT NOT NULL AUTO_INCREMENT,
  `id_produto` INT NOT NULL,
  `id_fornecedor` INT NOT NULL,
  `data` DATE NOT NULL,
  `valor_minimo` REAL NOT NULL,
  `valor_medio` REAL NOT NULL,
  PRIMARY KEY (`id_analise`, `id_produto`, `id_fornecedor`),
  INDEX `fk_analise_produto_produto1_idx` (`id_produto` ASC, `id_fornecedor` ASC) ,
  CONSTRAINT `fk_analise_produto_produto1`
    FOREIGN KEY (`id_produto` , `id_fornecedor`)
    REFERENCES `tads`.`produto` (`id_produto` , `id_fornecedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tads`.`projecao` (
  `id_projecao` INT NOT NULL AUTO_INCREMENT,
  `id_produto` INT NOT NULL,
  `id_fornecedor` INT NOT NULL,
  `data` DATE NOT NULL,
  `quantidade` INT NOT NULL,
  `desconto` REAL NOT NULL,
  `valor_unitario` REAL NOT NULL,
  `valor_total` REAL NOT NULL,
  PRIMARY KEY (`id_projecao`, `id_produto`, `id_fornecedor`),
  INDEX `fk_projecao_produto1_idx` (`id_produto` ASC, `id_fornecedor` ASC) ,
  CONSTRAINT `fk_projecao_produto1`
    FOREIGN KEY (`id_produto` , `id_fornecedor`)
    REFERENCES `tads`.`produto` (`id_produto` , `id_fornecedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;