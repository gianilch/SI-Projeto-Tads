<div class="container mt-5">
    <h2>Informações do Pedido</h2>
    <form action="?page=carregarTipoDePagamento" method="POST">
        <div class="form-row">
            <div class="form-group col">
                <label for="idVenda">Numero Pedido</label>
                <input type="number" class="form-control" id="idVenda" name="idVenda"
                    value="<?php echo $pedido['id_venda']; ?>" readonly>
            </div>
            <div class="form-group col">
                <label for="nomeVendedor">Nome do Vendedor</label>
                <input type="text" class="form-control" id="nomeVendedor" name="nomeVendedor"
                    value="<?php echo $pedido['funcionario']; ?>" readonly>
            </div>
            <div class="form-group col">
                <label for="nomeCliente">Nome do Cliente</label>
                <input type="text" class="form-control" id="nomeCliente" name="nomeCliente"
                    value="<?php echo $pedido['cliente']; ?>" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label for="dataPedido">Data Pedido</label>
                <input type="date" class="form-control" id="dataPedido" name="dataPedido"
                    value="<?php echo $pedido['data']; ?>" readonly>
            </div>
            <div class="form-group col">
                <label for="valorPedido">Valor Pedido R$</label>
                <input type="text" class="form-control" id="valorPedido" name="valorPedido"
                    value="<?php echo number_format($pedido['valor'], 2, ',', '.'); ?>" readonly>
            </div>
            <div class="form-group col">
                <label for="tipoPagamento">Tipo de Pagamento</label>
                <select onchange="this.form.submit()" class="custom-select mr-sm-2"
                    aria-label="Selecione o método de pagamento" id="tipoPagamento" name="tipoPagamento">
                    <?php
                    include("../model/banco.php");
                    $res = listarMeiosDePagamentosDisponiveis($conexao);
                    $qtd = $res->num_rows;
                    while ($row = $res->fetch_object()) {
                        echo '<option ' . ($row->id_pagamento == $pedido['id_pagamento'] ? "selected" : "") . ' value="' . $row->id_pagamento . '"> ' . $row->nome . ' -- Juros de: ' . $row->juros . '%' . ' </option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </form>
</div>