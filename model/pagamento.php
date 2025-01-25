<?php

include("../model/pedido.php");

function salvarPagamento($conexao, $id_venda, $quantidade_parcelas, $metodo_pagamento): mixed
{

    $venda = getPedido($conexao, $id_venda);

    if($venda['aceita_parcelamento' == 0]){
        $quantidade_parcelas = 1;
    }

    $valor_total_venda = $quantidade_parcelas == 1 ? $venda['valor'] : $venda['valor'] * (1 + $venda['juros'] / 100);

    $valor_parcela = $valor_total_venda / $quantidade_parcelas;


    $i = 1;
    while ($i <= $quantidade_parcelas) {
        try {
            $data_vencimento = date('Y-m-d', strtotime($venda['data'] . ' + ' . $venda['prazo_parcela'] * $i . 'days'));
            $sql = "INSERT INTO parcela(id_venda, id_cliente, id_funcionario, id_pagamento, valor_parcela, data_vencimento, numero_parcela) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("iiiidss", $venda['id_venda'], $venda['id_cliente'], $venda['id_funcionario'], $venda['id_pagamento'], $valor_parcela, $data_vencimento, $i);
            $stmt->execute();

            $referencia_hash = hash('sha256', $venda['id_venda'] . $i . microtime());
            $status_pagamento = "confirmado";
            $notas = "Pagamento efetuado com sucesso.";
            $sql_log = "INSERT INTO log_pagamento (id_pagamento, id_venda, metodo_pagamento, status_pagamento, referencia_hash, notas) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_log = $conexao->prepare($sql_log);
            $stmt_log->bind_param("iissss", $venda['id_pagamento'], $venda['id_venda'], $metodo_pagamento, $status_pagamento, $referencia_hash, $notas);
            $stmt_log->execute();
        } catch (Exception $e) {

            $referencia_hash = hash('sha256', $venda['id_venda'] . $i . microtime());
            $status_pagamento = "recusado";
            $notas = "Erro ao registrar parcela: " . $e->getMessage();

            $sql_log = "INSERT INTO log_pagamento (id_pagamento, id_venda, metodo_pagamento, status_pagamento, referencia_hash, notas) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_log = $conexao->prepare($sql_log);
            $stmt_log->bind_param("iissss", $venda['id_pagamento'], $venda['id_venda'], $metodo_pagamento, $status_pagamento, $referencia_hash, $notas);
            $stmt_log->execute();

            return false;
        }    
        $i++;
    }

    return True;
}