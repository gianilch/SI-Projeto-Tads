-- Schema `tads`
CREATE SCHEMA IF NOT EXISTS `tads` DEFAULT CHARACTER SET utf8;
USE `tads`;

-- Table `usuario`
CREATE TABLE IF NOT EXISTS `usuario` (
	`id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `senha` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
);

-- Table `fornecedor`
CREATE TABLE IF NOT EXISTS `fornecedor` (
  `id_fornecedor` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cnpj` VARCHAR(15) NULL,
  PRIMARY KEY (`id_fornecedor`)
);

-- Table `produto`
CREATE TABLE IF NOT EXISTS `produto` (
  `id_produto` INT NOT NULL AUTO_INCREMENT,
  `id_fornecedor` INT NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `valor` REAL NOT NULL,
  `codigo_barras` VARCHAR(15) NULL,
  `categoria` VARCHAR(45) NULL,
  `quantidade_estoque` INT NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `foto` VARCHAR(255) NULL,
  PRIMARY KEY (`id_produto`),
  FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id_fornecedor`)
);

-- Table `cliente`
CREATE TABLE IF NOT EXISTS `cliente` (
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
  PRIMARY KEY (`id_cliente`)
);

-- Table `endereco`
CREATE TABLE IF NOT EXISTS `endereco` (
  `id_endereco` INT NOT NULL AUTO_INCREMENT,
  `cliente_id_cliente` INT NULL,
  `fornecedor_id_fornecedor` INT NULL,
  `uf` VARCHAR(2) NULL,
  `cidade` VARCHAR(100) NULL,
  `logradouro` VARCHAR(45) NULL,
  `bairro` VARCHAR(45) NULL,
  `numero` VARCHAR(45) NULL,
  `cep` VARCHAR(45) NULL,
  `complemento` VARCHAR(45) NULL,
  PRIMARY KEY (`id_endereco`),
  FOREIGN KEY (`cliente_id_cliente`) REFERENCES `cliente` (`id_cliente`),
  FOREIGN KEY (`fornecedor_id_fornecedor`) REFERENCES `fornecedor` (`id_fornecedor`)
);

-- Table `funcionario`
CREATE TABLE IF NOT EXISTS `funcionario` (
  `id_funcionario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `salario` REAL NULL,
  `meta` REAL NULL,
  `cargo` VARCHAR(100) NULL,
  `comissao` REAL NULL,
  PRIMARY KEY (`id_funcionario`)
);

-- Table `forma_pagamento`
CREATE TABLE IF NOT EXISTS `forma_pagamento` (
  `id_pagamento` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `aceita_parcelamento` TINYINT NOT NULL,
  `prazo_parcela` INT NULL,
  `juros` REAL NULL,
  PRIMARY KEY (`id_pagamento`)
);

-- Table `venda`
CREATE TABLE IF NOT EXISTS `venda` (
  `id_venda` INT NOT NULL AUTO_INCREMENT,
  `id_cliente` INT NOT NULL,
  `id_funcionario` INT NOT NULL,
  `id_pagamento` INT NOT NULL,
  `valor` REAL NULL,
  `data` DATE NULL,
  PRIMARY KEY (`id_venda`),
  FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`),
  FOREIGN KEY (`id_pagamento`) REFERENCES `forma_pagamento` (`id_pagamento`)
);

-- Table `itens_venda`
CREATE TABLE IF NOT EXISTS `itens_venda` (
  `id_itens_venda` INT NOT NULL AUTO_INCREMENT,
  `id_produto` INT NOT NULL,
  `id_venda` INT NOT NULL,
  `desconto_item` REAL NULL,
  PRIMARY KEY (`id_itens_venda`),
  FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`),
  FOREIGN KEY (`id_venda`) REFERENCES `venda` (`id_venda`)
);

-- Table `estoque`
CREATE TABLE IF NOT EXISTS `estoque` (
  `id_estoque` INT NOT NULL AUTO_INCREMENT,
  `id_produto` INT NOT NULL,
  `quantidade` VARCHAR(45) NOT NULL,
  `tipo_movimentacao` VARCHAR(45) NOT NULL,
  `data_movimentacao` DATE NOT NULL,
  PRIMARY KEY (`id_estoque`),
  FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`)
);

-- Table `parcela`
CREATE TABLE IF NOT EXISTS `parcela` (
  `id_parcela` INT NOT NULL AUTO_INCREMENT,
  `id_venda` INT NOT NULL,
  `id_cliente` INT NOT NULL,
  `id_funcionario` INT NOT NULL,
  `id_pagamento` INT NOT NULL,
  `valor_parcela` REAL NOT NULL,
  `data_vencimento` DATE NOT NULL,
  `data_pagamento` DATE NULL,
  `numero_parcela` INT NOT NULL,
  `confirma_pagamento` TINYINT NULL,
  PRIMARY KEY (`id_parcela`),
  FOREIGN KEY (`id_venda`) REFERENCES `venda` (`id_venda`),
  FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`),
  FOREIGN KEY (`id_pagamento`) REFERENCES `forma_pagamento` (`id_pagamento`)
);

-- Table `status_chamado`
CREATE TABLE IF NOT EXISTS `status_chamado` (
  `id_status_chamado` INT NOT NULL AUTO_INCREMENT,
  `situacao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_status_chamado`)
);

-- Table `satisfacao_feedback`
CREATE TABLE IF NOT EXISTS `satisfacao_feedback` (
  `id_satisfacao` INT NOT NULL AUTO_INCREMENT,
  `nota_satisfacao` INT NULL,
  `feedback_atendimento` VARCHAR(255) NULL,
  PRIMARY KEY (`id_satisfacao`)
);

-- Table `chamado`
CREATE TABLE IF NOT EXISTS `chamado` (
  `id_chamado` INT NOT NULL AUTO_INCREMENT,
  `id_venda` INT NOT NULL,
  `id_cliente` INT NOT NULL,
  `id_funcionario` INT NOT NULL,
  `id_pagamento` INT NOT NULL,
  `id_status_chamado` INT NOT NULL,
  `id_satisfacao` INT NOT NULL,
  `descricao` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`id_chamado`),
  FOREIGN KEY (`id_venda`) REFERENCES `venda` (`id_venda`),
  FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`),
  FOREIGN KEY (`id_pagamento`) REFERENCES `forma_pagamento` (`id_pagamento`),
  FOREIGN KEY (`id_status_chamado`) REFERENCES `status_chamado` (`id_status_chamado`),
  FOREIGN KEY (`id_satisfacao`) REFERENCES `satisfacao_feedback` (`id_satisfacao`)
);

-- Table `conta_pagar`
CREATE TABLE IF NOT EXISTS `conta_pagar` (
  `id_parcela` INT NOT NULL AUTO_INCREMENT,
  `id_fornecedor` INT NOT NULL,
  `valor_parcela` REAL NOT NULL,
  `data_vencimento` DATE NOT NULL,
  `data_pagamento` DATE NULL,
  `numero_parcela` INT NOT NULL,
  `confirma_pagamento` TINYINT NULL,
  PRIMARY KEY (`id_parcela`),
  FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id_fornecedor`)
);

-- Table `analise_produto`
CREATE TABLE IF NOT EXISTS `analise_produto` (
  `id_analise` INT NOT NULL AUTO_INCREMENT,
  `id_produto` INT NOT NULL,
  `id_fornecedor` INT NOT NULL,
  `data` DATE NOT NULL,
  `valor_minimo` REAL NOT NULL,
  `valor_medio` REAL NOT NULL,
  PRIMARY KEY (`id_analise`),
  FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`),
  FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id_fornecedor`)
);

-- Table `projecao`
CREATE TABLE IF NOT EXISTS `projecao` (
  `id_projecao` INT NOT NULL AUTO_INCREMENT,
  `id_produto` INT NOT NULL,
  `id_fornecedor` INT NOT NULL,
  `data` DATE NOT NULL,
  `quantidade` INT NOT NULL,
  `desconto` REAL NOT NULL,
  `valor_unitario` REAL NOT NULL,
  `valor_total` REAL NOT NULL,
  PRIMARY KEY (`id_projecao`),
  FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`),
  FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id_fornecedor`)
);
-- Tabela de Log
CREATE TABLE IF NOT EXISTS `log_pagamento` (
    `id_log` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_pagamento` INT NOT NULL,
    `id_venda` INT NOT NULL,
    `data_hora` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `metodo_pagamento` VARCHAR(50),
    `status_pagamento` ENUM('confirmado', 'recusado'),
    `referencia_hash` VARCHAR(255),
    `notas` TEXT
);