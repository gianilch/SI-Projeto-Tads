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
                <input type="text" maxlength="16" minlegth="13" class="form-control" id="numeroCartao"
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
                    <option selected value="1">1 x R$ <?php echo number_format($pedido['valor'], 2, ',', '.'); ?>
                    </option>
                    <option value="2">2 x R$
                        <?php echo number_format(($pedido['valor'] * (1 + $pedido['juros'] / 100) / 2), 2, ',', '.'); ?>
                    </option>
                    <option value="3">3 x R$
                        <?php echo number_format(($pedido['valor'] * (1 + $pedido['juros'] / 100) / 3), 2, ',', '.'); ?>
                    </option>
                    <option value="4">4 x R$
                        <?php echo number_format(($pedido['valor'] * (1 + $pedido['juros'] / 100) / 4), 2, ',', '.'); ?>
                    </option>
                    <option value="5">5 x R$
                        <?php echo number_format(($pedido['valor'] * (1 + $pedido['juros'] / 100) / 5), 2, ',', '.'); ?>
                    </option>
                    <option value="6">6 x R$
                        <?php echo number_format(($pedido['valor'] * (1 + $pedido['juros'] / 100) / 6), 2, ',', '.'); ?>
                    </option>
                    <option value="7">7 x R$
                        <?php echo number_format(($pedido['valor'] * (1 + $pedido['juros'] / 100) / 7), 2, ',', '.'); ?>
                    </option>
                    <option value="8">8 x R$
                        <?php echo number_format(($pedido['valor'] * (1 + $pedido['juros'] / 100) / 8), 2, ',', '.'); ?>
                    </option>
                    <option value="9">9 x R$
                        <?php echo number_format(($pedido['valor'] * (1 + $pedido['juros'] / 100) / 9), 2, ',', '.'); ?>
                    </option>
                    <option value="10">10 x R$
                        <?php echo number_format(($pedido['valor'] * (1 + $pedido['juros'] / 100) / 10), 2, ',', '.'); ?>
                    </option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Confirmar Informações</button>
    </form>
</div>