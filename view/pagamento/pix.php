<div class="container mt-5">
  <h2>QRCODE PIX</h2>
  <form action="?page=salvarPagamento" method="POST">
    <!-- Campo oculto para enviar o ID do usuário -->
    <input type="hidden" name="idVenda" value="<?php echo $pedido['id_venda']; ?>">
    <div class="form-group">
      <img src="../assets/pix.png" class="rounded mx-auto d-block" alt="qrcodepix">
    </div>
    <button type="submit" class="btn btn-primary">Pix realizado</button>
  </form>
</div>