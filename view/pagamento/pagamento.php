<?php
$paymentType = isset($_GET['paymentType']) ? $_GET['paymentType'] : '';
?>
<div class="container mt-5">
    <h2>Formas de Pagamento</h2>
    <div class="form-check form-check-inline">
        <a href="?paymentType=pix" class="btn btn-outline-primary <?php if ($paymentType == 'pix') echo 'active'; ?>">
            PIX
        </a>
    </div>
    <div class="form-check form-check-inline">
        <a href="?paymentType=cartao" class="btn btn-outline-primary <?php if ($paymentType == 'cartao') echo 'active'; ?>">
            Cartão
        </a>
    </div>

    <?php
    if ($paymentType == 'pix') {
        include 'pix.php';
    } elseif ($paymentType == 'cartao') {
        include 'cartao.php';
    }
    ?>
</div>