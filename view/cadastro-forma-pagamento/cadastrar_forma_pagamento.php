<div class="container mt-5">
  <h2>Cadastro de Forma de Pagamento</h2>
  <form action="?page=salvar" method="POST">
    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" required>
    </div>
    <div class="form-group">
      <label for="tipo_pagamento">Tipo de Pagamento</label>
      <select class="custom-select mr-sm-2" aria-label="Selecione o tipo" id="tipo_pagamento" name="tipo_pagamento"
        required>
        <option selected value="Cartão de Crédito">Cartão de Crédito</option>
        <option value="PIX">PIX</option>
      </select>
    </div>
    <div class="form-group">
      <label for="aceita_parcelamento">Aceita Parcelamento</label>
      <select class="custom-select mr-sm-2" aria-label="Selecione o tipo" id="aceita_parcelamento"
        name="aceita_parcelamento" required>
        <option selected value="0">Não</option>
        <option value="1">Sim</option>
      </select>
    </div>
    <div class="form-group">
      <label for="prazo_parcela">Prazo Parcela</label>
      <select class="custom-select mr-sm-2" aria-label="Selecione o prazo" id="prazo_parcela" name="prazo_parcela"
        required>
        <option selected value="0">0</option>
        <option value="30">30</option>
        <option value="45">45</option>
        <option value="60">60</option>
      </select>
    </div>
    <div class="form-group">
      <label for="juros">% Juros ao mês</label>
      <input type="number" step=".01" class="form-control" id="juros" name="juros" placeholder="00.00" required>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </form>
</div>