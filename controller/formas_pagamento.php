<?php

include("../model/banco.php");
include("../view/template.php");

switch (@$_REQUEST["page"]) {
  case "listar":
    include("../view/pagamento/formas_pagamento.php");
    break;
  case "novo":
    include("../view/pagamento/cadastrar_forma_pagamento.php");
    break;
  default:
    include("../view/template.php");
    break;

}