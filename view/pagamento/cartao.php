<div class="container mt-5">
    <form action="?page=salvar" method="POST">
        <div class="form-group">
            <label for="nome">Nome *</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" required>
        </div>
        <div class="form-group">
            <label for="cpf">CPF *</label>
            <input type="text" maxlength="11" class="form-control" id="cpf" name="cpf" placeholder="Digite seu CPF" required>
        </div>
        <div class="form-group">
            <label for="numeroCartao">Numero do Cartão *</label>
            <input type="text" maxlength="16" minlegth="13" class="form-control" id="numeroCartao" name="numeroCartao" placeholder="Digite o Numero do Cartão" required>
        </div>
        <button type="submit" class="btn btn-primary">Concluir Pagamento</button>
    </form>
</div>