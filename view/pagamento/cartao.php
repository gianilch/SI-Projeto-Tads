<div class="container mt-5">
    <h2>Informações do Cartão de Crédito</h2>
    <form action="?page=salvarPagamento" method="POST">
        <!-- Campo oculto para enviar o ID do usuário -->
        <input type="hidden" name="idVenda" value="<?php echo $pedido['id_venda']; ?>">
        <div class="form-row">
            <div class="form-group col">
                <label for="nome">Nome do Titular</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" required>
            </div>
            <div class="form-group col">
                <label for="cpf">CPF do Titular</label>
                <input type="text" maxlength="11" class="form-control" id="cpf" name="cpf" placeholder="Digite seu CPF"
                    required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label for="numeroCartao">Numero do Cartão</label>
                <input type="text" maxlength="20" minlegth="13" class="form-control" id="numeroCartao"
                    name="numeroCartao" placeholder="Digite o Numero do Cartão" required>
            </div>
            <div class="form-group col">
                <label for="cvvCartao">CVV do Cartão</label>
                <input type="text" maxlength="16" minlegth="13" class="form-control" id="cvvCartao" name="cvvCartao"
                    placeholder="Digite o CVV do Cartão" required>
            </div>
            <div class="form-group col">
                <label for="numeroParcelas">Numero de Parcelas</label>
                <select class="custom-select mr-sm-2" aria-label="Selecione as parcelas" id="numeroParcelas"
                    name="numeroParcelas" required>
                    <?php
                    $row = 1;
                    $maximo_parcela = $pedido['aceita_parcelamento'] == 1 ? 10 : 1;
                    while ($row <= $maximo_parcela) {
                        echo '<option ' . ($row == 1 ? "selected" : "") . ' value="' . $row . '">' . $row . ' x R$ ' . number_format(($pedido['valor'] * (1 + ($row == 1 ? 0 : $pedido['juros']) / 100) / $row), 2, ',', '.') . '
                    </option>';
                        $row++;
                    } ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Confirmar Informações</button>
    </form>
</div>