<?php

include("../model/pedido.php");

function salvarPagamento($conexao, $id_venda, $quantidade_parcelas): mixed
{

    $venda = getPedido($conexao, $id_venda);

    if ($venda['aceita_parcelamento' == 0]) {
        $quantidade_parcelas = 1;
    }

    $valor_total_venda = $quantidade_parcelas == 1 ? $venda['valor'] : $venda['valor'] * (1 + $venda['juros'] / 100);

    $valor_parcela = $valor_total_venda / $quantidade_parcelas;


    $i = 1;
    while ($i <= $quantidade_parcelas) {
        $data_vencimento = date('Y-m-d', strtotime($venda['data'] . ' + ' . $venda['prazo_parcela'] * $i . 'days'));
        $sql = "INSERT INTO parcela(id_venda, id_cliente, id_funcionario, id_pagamento, valor_parcela, data_vencimento, numero_parcela) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("iiiidss", $venda['id_venda'], $venda['id_cliente'], $venda['id_funcionario'], $venda['id_pagamento'], $valor_parcela, $data_vencimento, $i);
        $stmt->execute();
        $i++;
    }

    return True;
}