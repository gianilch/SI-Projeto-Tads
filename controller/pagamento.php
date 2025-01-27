<?php

include("../model/banco.php");
include("../view/template.php");
include("../view/pagamento/pagamento.php");
include("../model/forma_pagamento.php");
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
    $metodo_pagamento = $_POST['metodoPagamento'];
    $numero_cartao = $_POST['numeroCartao'];

    if ($numero_cartao) {

      $numero_cartao_tratado = preg_replace('/\D/', '', $numero_cartao);

      if (empty($numero_cartao_tratado) || !ctype_digit($numero_cartao_tratado)) {
        echo "<script>alert('Não foi possível salvar o pagamento, pois o número do cartão " . $numero_cartao . " é inválido. Err:01'); </script>";
        echo "<script>location.href='?';</script>";
        exit;
      }

      $soma = 0;
      $quantidadeDigitos = strlen($numero_cartao_tratado);
      $paridade = $quantidadeDigitos % 2;

      for ($i = 0; $i < $quantidadeDigitos; $i++) {
        $digito = (int) $numero_cartao_tratado[$i];

        if ($i % 2 === $paridade) {
          $digito *= 2;
          if ($digito > 9) {
            $digito -= 9;
          }
        }

        $soma += $digito;
      }

      if ($soma % 10 !== 0) {
        echo "<script>alert('Não foi possível salvar o pagamento, pois o número do cartão é inválido. Err:02'); </script>";
        echo "<script>location.href='?';</script>";
        exit;
      }

    }

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
  case "carregarTipoDePagamento":
    $id_venda = $_POST['idVenda'];
    $id_tipo_pagamento = $_POST['tipoPagamento'];

    if (!$id_venda) {
      echo "<script>alert('Informe o id do pedido.'); </script>";
      break;
    }


    $pedidoOld = getPedido($conexao, $id_venda);
    $tipo_pagamento = getFormaPagamento($conexao, $id_tipo_pagamento);

    if ($pedidoOld && $tipo_pagamento) {
      atualizaMeioPagamento($conexao, $id_venda, $id_tipo_pagamento);
      $pedido = getPedido($conexao, $id_venda);
      include("../view/pagamento/informacao_pedido_pagamento.php");


      if (str_contains($tipo_pagamento['nome'], 'Cartão de Crédito')) {
        include("../view/pagamento/cartao.php");
      } else if (str_contains($tipo_pagamento['nome'], 'PIX')) {
        include("../view/pagamento/pix.php");
      }
    } else {
      echo "<script>alert('Não foi possível localizar o pedido " . $id . ".'); </script>";
      break;
    }
    break;
  default:
    break;

}

?>