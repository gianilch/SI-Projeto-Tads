<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paymentType = isset($_POST['paymentTypeRadioOptions']) ? $_POST['paymentTypeRadioOptions'] : '';
}
?>
<div class="container mt-5">
    <h2>Formas de Pagamento</h2>
    <form action="" method="POST">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="paymentTypeRadioOptions" id="radioPix" value="pix" <?php if (isset($paymentType) && $paymentType == 'pix') echo 'checked'; ?> onchange="this.form.submit()">
            <label class="form-check-label" for="radioPix">PIX</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="paymentTypeRadioOptions" id="radioCartao" value="cartao" <?php if (isset($paymentType) && $paymentType == 'cartao') echo 'checked'; ?> onchange="this.form.submit()">
            <label class="form-check-label" for="radioCartao">Cartão</label>
        </div>
    </form>

    <?php
    if (isset($paymentType) && $paymentType == 'pix') {
        include 'pix.php';
    } elseif (isset($paymentType) && $paymentType == 'cartao') {
        include 'cartao.php';
    }
    ?>
</div>