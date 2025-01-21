<?php

function salvarFormaPagamento($conexao, $nome, $tipo, $aceita_parcelamento, $prazo_parcela, $juros, $id = null): mixed
{
  if ($id) {

    $sql = "UPDATE forma_pagamento SET nome = ?, email = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssi", $nome, $tipo, $aceita_parcelamento, $id);

  } else {
    $sql = "INSERT INTO forma_pagamento(nome, tipo, aceita_parcelamento, prazo_parcela, juros) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssiid", $nome, $tipo, $aceita_parcelamento, $prazo_parcela, $juros);
  }
  return $stmt->execute();
}

function excluirFormaPagamento($conexao, $id)
{
  $sql = "DELETE FROM forma_pagamento WHERE id = ?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("i", $id);

  return $stmt->execute();
}
?>