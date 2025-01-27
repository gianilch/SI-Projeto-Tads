<?php

function salvarFormaPagamento($conexao, $nome, $tipo, $aceita_parcelamento, $prazo_parcela, $juros, $id = null): mixed
{
  if ($id) {

    $sql = "UPDATE forma_pagamento SET nome = ?, tipo = ?, aceita_parcelamento = ?, prazo_parcela = ?, juros = ? WHERE id_pagamento = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssiidi", $nome, $tipo, $aceita_parcelamento, $prazo_parcela, $juros, $id);

  } else {
    $sql = "INSERT INTO forma_pagamento(nome, tipo, aceita_parcelamento, prazo_parcela, juros) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssiid", $nome, $tipo, $aceita_parcelamento, $prazo_parcela, $juros);
  }
  return $stmt->execute();
}

function excluirFormaPagamento($conexao, $id)
{
  $sql = "DELETE FROM forma_pagamento WHERE id_pagamento = ?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("i", $id);

  return $stmt->execute();
}

function getFormaPagamento($conexao, $id)
{
  $sql = "SELECT * FROM forma_pagamento WHERE id_pagamento = ?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->fetch_assoc();
}

function listarMeiosDePagamentosDisponiveis($conexao): mixed
{
  $sql = "SELECT * FROM forma_pagamento";
  $res = $conexao->query($sql);
  return $res;
}
?>