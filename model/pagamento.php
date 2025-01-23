<?php

include("../model/pedido.php");
include("../model/forma_pagamento.php");

function salvarPagamento($conexao, $id_venda, $quantidade_parcelas, ): mixed
{
    $venda = getPedido($conexao, $id_venda);

    $tipo_pagamento = getFormaPagamento($conexao, $venda['id_pagamento']);

    $valor_total_venda = $quantidade_parcelas == 1 ? $venda->valor_total : $venda->valor_total * (1 + $tipo_pagamento['juros'] / 100);

    $valor_parcela = $valor_total_venda / $quantidade_parcelas;

    $i = 1;
    while ($i <= $quantidade_parcelas) {
        $sql = "INSERT INTO parcelas(id_venda, id_cliente, id_funcionario, id_pagamento, valor_parcela, data_vencimento, numero_parcela) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("iiiidss", $venda['id_venda'], $venda['id_cliente'], $venda['id_funcionario'], $venda['id_pagamento'], $valor_parcela, date('Y-m-d', strtotime($venda['data']. ' + ' . $tipo_pagamento['prazo_parcela'] * $i . 'days')), $i . '/' . $quantidade_parcelas  );
    }

    return $stmt->execute();
}