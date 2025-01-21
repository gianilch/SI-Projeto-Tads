<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema TADS</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body style="background-color: #F8F9FA">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Sistema TADS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="../view/template.php">Página Inicial <span class="sr-only">(Página atual)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownCadastros" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Cadastros
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownCadastros">
            <a class="dropdown-item" href="#">Clientes</a>
            <a class="dropdown-item" href="#">Produtos</a>
            <a class="dropdown-item" href="#">Fornecedor</a>
            <a class="dropdown-item" href="#">Funcionário</a>
            <a class="dropdown-item" href="../controller/usuario.php?page=listar">Usuários</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownProcessos" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Processos
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownProcessos">
            <a class="dropdown-item" href="#">Lançar Venda</a>
            <a class="dropdown-item" href="#">Entrada no Estoque</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownFinanceiro" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Financeiro
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownFinanceiro">
            <a class="dropdown-item" href="../controller/formas_pagamento.php?page=listar">Formas de Pagamento</a>
            <a class="dropdown-item" href="../controller/pagamento.php">Pagamento</a>
            <a class="dropdown-item" href="#">Contas a Receber</a>
            <a class="dropdown-item" href="#">Contas a Pagar</a>
            <a class="dropdown-item" href="#">Inadimplentes</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownProjecoes" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Projeções
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownProjecoes">
            <a class="dropdown-item" href="#">Projeção de Promoção</a>
            <a class="dropdown-item" href="#">Projeção de Venda</a>
            <a class="dropdown-item" href="#">Projeção de Preço</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownRelatorios" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Relatórios
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownRelatorios">
            <a class="dropdown-item" href="#">Dashboards</a>
            <a class="dropdown-item" href="#">Relatório 1</a>
            <a class="dropdown-item" href="#">Relatório 2</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownSuporte" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Suporte
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownSuporte">
            <a class="dropdown-item" href="#">Controle de Chamados</a>
            <a class="dropdown-item" href="#">Feedbacks</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>



  <!-- JavaScript do Bootstrap e dependências -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>

</body>

</html>