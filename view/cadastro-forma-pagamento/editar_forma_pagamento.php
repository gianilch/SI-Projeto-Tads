<div class="container mt-5">
    <h2>Editar Forma de Pagamento</h2>
    <form action="?page=salvar" method="POST">
        <input type="hidden" name="id" value="<?php echo $forma_pagamento['id_pagamento']; ?>">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome"
                value="<?php echo $forma_pagamento['nome']; ?>" placeholder="Digite seu nome" required>
        </div>
        <div class="form-group">
            <label for="tipo_pagamento">Tipo de Pagamento</label>
            <select class="custom-select mr-sm-2" aria-label="Selecione o tipo" id="tipo_pagamento"
                name="tipo_pagamento" required>
                <option value="Cartão de Crédito" <?php echo $forma_pagamento['nome'] == 'Cartão de Crédito' ? 'selected' : ''; ?>>Cartão de Crédito</option>
                <option value="PIX" <?php echo $forma_pagamento['nome'] == 'PIX' ? 'selected' : ''; ?>>PIX</option>
            </select>
        </div>
        <div class="form-group">
            <label for="aceita_parcelamento">Aceita Parcelamento</label>
            <select class="custom-select mr-sm-2" aria-label="Selecione o tipo" id="aceita_parcelamento"
                name="aceita_parcelamento" required>
                <option value="0" <?php echo $forma_pagamento['aceita_parcelamento'] == 0 ? 'selected' : ''; ?>>Não
                </option>
                <option value="1" <?php echo $forma_pagamento['aceita_parcelamento'] == 1 ? 'selected' : ''; ?>>Sim
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="prazo_parcela">Prazo Parcela</label>
            <select class="custom-select mr-sm-2" aria-label="Selecione o prazo" id="prazo_parcela" name="prazo_parcela"
                required>
                <option value="0" <?php echo $forma_pagamento['prazo_parcela'] == 0 ? 'selected' : ''; ?>>0</option>
                <option value="30" <?php echo $forma_pagamento['prazo_parcela'] == 30 ? 'selected' : ''; ?>>30</option>
                <option value="45" <?php echo $forma_pagamento['prazo_parcela'] == 45 ? 'selected' : ''; ?>>45</option>
                <option value="60" <?php echo $forma_pagamento['prazo_parcela'] == 60 ? 'selected' : ''; ?>>60</option>
            </select>
        </div>
        <div class="form-group">
            <label for="juros">% Juros ao mês</label>
            <input type="number" step=".01" class="form-control" id="juros" name="juros" placeholder="00.00"
                value="<?php echo $forma_pagamento['juros']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>