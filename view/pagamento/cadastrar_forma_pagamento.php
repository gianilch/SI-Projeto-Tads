<div class="container mt-5">
  <h2>Cadastro de Forma de Pagamento</h2>
  <form action="?page=salvar" method="POST">
    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" required>
    </div>
    <div class="form-group">
      <label for="tipo_pagamento">Tipo de Pagamento</label>
      <select class="form-select" aria-label="Selecione o tipo" id="tipo_pagamento" name="tipo_pagamento" required>
        <option selected value="À Vista">À Vista</option>
        <option value="À Prazo">À Prazo</option>
      </select>
    </div>
    <div class="form-group">
      <label for="aceita_parcelamento">Aceita Parcelamento</label>
      <select class="form-select" aria-label="Selecione o tipo" id="aceita_parcelamento" name="aceita_parcelamento"
        required>
        <option selected value="0">Não</option>
        <option value="1">Sim</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </form>
</div>