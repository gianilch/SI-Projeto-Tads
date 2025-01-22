<?php

include("../model/banco.php");
include("../view/template.php");
include("../view/pagamento/pagamento.php");
include("../model/pedido.php");

switch (@$_REQUEST["page"]) {
  case "buscarPedido":
    $id = $_POST['id'];

    if (!$id) {
      echo "<script>alert('Informe o id do pedido.'); </script>";
      break;
    }

    $pedido = getPedido($conexao, $id);

    if ($pedido) {

    } else {
      echo "<script>alert('Não foi possível localizar o pedido " . $id . ".'); </script>";
      break;
    }
    break;
  default:
    break;

}

?>