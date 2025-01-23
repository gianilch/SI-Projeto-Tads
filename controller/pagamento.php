<?php

include("../model/banco.php");
include("../view/template.php");
include("../view/pagamento/pagamento.php");
include("../model/pagamento.php");

switch (@$_REQUEST["page"]) {
  case "buscarPedido":
    $id = $_POST['id'];

    if (!$id) {
      echo "<script>alert('Informe o id do pedido.'); </script>";
      break;
    }

    $pedido = getPedido($conexao, $id);

    if ($pedido) {
      include("../view/pagamento/informacao_pedido_pagamento.php");

      if (str_contains($pedido['nome_metodo_pagamento'], 'Cartão de Crédito')) {
        include("../view/pagamento/cartao.php");
      } else if (str_contains($pedido['nome_metodo_pagamento'], 'PIX')) {
        include("../view/pagamento/pix.php");
      }

    } else {
      echo "<script>alert('Não foi possível localizar o pedido " . $id . ".'); </script>";
      break;
    }
    break;
  case "salvarPagamento":
    $id_venda = $_POST['idVenda'];
    $parcelas = $_POST['numeroParcelas'];

    if (!$parcelas) {
      $parcelas = 1;
    }

    if (salvarPagamento($conexao, $id_venda, $parcelas)) {
      echo "<script>alert('Pagamento salvo com sucesso'); </script>";
    } else {
      echo "<script>alert('Não foi possível salvar o pagamento'); </script>";

    }
    echo "<script>location.href='?page=listar';</script>";
    break;
  default:
    break;

}

?>