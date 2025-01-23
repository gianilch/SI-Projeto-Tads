<?php
function getPedido($conexao, $id)
{
  $sql = "SELECT ven.id_venda, ven.valor, ven.data, cli.id_cliente, cli.nome as cliente, cli.limite_credito, fun.id_funcionario, fun.nome as funcionario, fpag.nome as nome_metodo_pagamento, ven.id_pagamento, fpag.tipo as tipo_pagamento, fpag.aceita_parcelamento, fpag.prazo_parcela, fpag.juros FROM venda ven INNER JOIN cliente cli ON ven.id_cliente = cli.id_cliente INNER JOIN funcionario fun ON ven.id_funcionario = fun.id_funcionario INNER JOIN forma_pagamento fpag ON ven.id_pagamento = fpag.id_pagamento WHERE ven.id_venda = ?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->fetch_assoc();
}

?>