<?php

    include("../model/banco.php");
    include("../view/template.php");

    switch(@$_REQUEST["page"]){
        default:
            include("../view/pagamento/pagamento.php");
            break;

    }

?>