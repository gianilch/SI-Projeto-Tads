INSERT INTO `cliente`
            (`id_cliente`,
             `cpf`,
             `nome`,
             `telefone`,
             `score`,
             `data_nascimento`,
             `limite_credito`,
             `email`,
             `recebe_whatsapp`,
             `recebe_email`,
             `recebe_sms`)
VALUES      (NULL,
             '11111111111',
             'Cliente Para Teste',
             '4235222222',
             '700',
             '1999-11-29',
             '8000',
             'teste@cliente.com.br',
             '1',
             '1',
             '1'); 

INSERT INTO `funcionario`
            (`id_funcionario`,
             `nome`,
             `email`,
             `salario`,
             `meta`,
             `cargo`,
             `comissao`)
VALUES      (NULL,
             'Funcionario Teste',
             'funcionario@teste.com.br',
             '8000',
             '120000',
             'Vendedor',
             '5'); 

INSERT INTO `forma_pagamento`
            (`id_pagamento`,
             `nome`,
             `tipo`,
             `aceita_parcelamento`,
             `prazo_parcela`,
             `juros`)
VALUES      (NULL,
             'PIX',
             'PIX',
             '0',
             '0',
             '0'),
            (NULL,
             'Cartão de Crédito',
             'À Prazo',
             '1',
             '30',
             '10') 

INSERT INTO `venda`
            (`id_venda`,
             `id_cliente`,
             `id_funcionario`,
             `id_pagamento`,
             `valor`,
             `data`)
VALUES      ('1',
             '1',
             '1',
             '2',
             '12000',
             '2025-01-22'); 