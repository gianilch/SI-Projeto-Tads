<?php

include("../model/banco.php");
include("../model/formas_pagamento.php");
include("../view/template.php");

switch (@$_REQUEST["page"]) {
  case "listar":
    include("../view/pagamento/formas_pagamento.php");
    break;
  case "novo":
    include("../view/pagamento/cadastrar_forma_pagamento.php");
    break;
  case "salvar":
    $nome = $_POST['nome'];
    $tipo_pagamento = $_POST['tipo_pagamento'];
    $aceita_parcelamento = $_POST['aceita_parcelamento'];
    $prazo_parcela = $_POST['prazo_parcela'];
    $juros = $_POST['juros'];
    $id = isset($_POST['id']) && !empty($_POST['id']) ? intval($_POST['id']) : null;

    if (salvarFormaPagamento($conexao, $nome, $tipo_pagamento, $aceita_parcelamento, $prazo_parcela, $juros, $id)) {
      echo "<script>alert('Forma de pagamento " . ($id ? "atualizado" : "cadastrado") . " com sucesso'); </script>";
    } else {
      echo "<script>alert('Não foi possível " . ($id ? "atualizar" : "cadastrar") . " a forma de pagamento.'); </script>";

    }
    echo "<script>location.href='?page=listar';</script>";
    break;
  default:
    include("../view/template.php");
    break;

}