<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<div class="container mt-5">
    <h2>Informações do Cartão de Crédito</h2>
    <form action="?page=salvarPagamento" method="POST">
        <!-- Campo oculto para enviar o ID do usuário -->
        <input type="hidden" name="idVenda" value="<?php echo $pedido['id_venda']; ?>">
        <input type="hidden" name="metodoPagamento" value="Cartão de crédito">
        <div class="form-row">
            <div class="form-group col">
                <label for="nome">Nome do Titular</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" required>
            </div>
            <div class="form-group col">
                <label for="cpf">CPF do Titular</label>
                <input type="text" maxlength="11" class="form-control" id="cpf" name="cpf" placeholder="Digite seu CPF"
                    required>
                <small id="cpfFeedback" class="form-text text-danger" style="display: none;">
                    CPF inválido!
</small>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label for="numeroCartao">Número do Cartão</label>
                <input type="text" maxlength="19" minlength="13" class="form-control" id="numeroCartao"
                    name="numeroCartao" placeholder="Digite o Número do Cartão" required>
                <small id="numeroCartaoFeedback" class="form-text text-danger" style="display: none;">
                    Número de cartão inválido!
                </small>
            </div>
            <div class="form-group col">
                <label for="cvvCartao">CVV do Cartão</label>
                <input type="text" maxlength="3" minlength="3" class="form-control" id="cvvCartao" name="cvvCartao"
                    placeholder="Digite o CVV do Cartão" required>
            </div>
            <div class="form-group col">
                <label for="numeroParcelas">Número de Parcelas</label>
                <select class="custom-select mr-sm-2" aria-label="Selecione as parcelas" id="numeroParcelas"
                    name="numeroParcelas" required>
                    <option selected value="1">1 x R$ <?php echo number_format($pedido['valor'], 2, ',', '.'); ?>
                    </option>
                    <?php for ($i = 2; $i <= 10; $i++): ?>
                    <option value="<?= $i; ?>"><?= $i; ?> x R$
                        <?= number_format(($pedido['valor'] * (1 + $pedido['juros'] / 100) / $i), 2, ',', '.'); ?>
                    </option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Confirmar Informações</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        // Aplica a máscara ao campo de CPF
        $('#cpf').mask('000.000.000-00');

        // Função para validar o CPF
        function validarCPF(cpf) {
            cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos
            
            // Verifica se o CPF possui 11 dígitos ou é uma sequência inválida
            if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
                return false;
            }

            // Validação do primeiro dígito verificador
            let soma = 0;
            for (let i = 0; i < 9; i++) {
                soma += parseInt(cpf.charAt(i)) * (10 - i);
            }
            let resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.charAt(9))) {
                return false;
            }

            // Validação do segundo dígito verificador
            soma = 0;
            for (let i = 0; i < 10; i++) {
                soma += parseInt(cpf.charAt(i)) * (11 - i);
            }
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.charAt(10))) {
                return false;
            }

            return true;
        }

        // Evento para validação em tempo real
        $('#cpf').on('input', function () {
            const cpf = $(this).val();
            const isValido = validarCPF(cpf);

            // Exibir feedback
            $('#cpfFeedback').toggle(!isValido && cpf.length === 14);
        });
    });

    // Algoritmo de Luhn para validar o número do cartão
    function validarCartaoCredito(numeroCartao) {
        const numero = numeroCartao.replace(/\D/g, ''); // Remove espaços e caracteres não numéricos
        let soma = 0;
        let deveDobrar = false;

        for (let i = numero.length - 1; i >= 0; i--) {
            let digito = parseInt(numero.charAt(i), 10);

            if (deveDobrar) {
                digito *= 2;
                if (digito > 9) {
                    digito -= 9;
                }
            }

            soma += digito;
            deveDobrar = !deveDobrar;
        }

        return soma % 10 === 0;
    }

    // Verificação do número do cartão em tempo real
    document.getElementById('numeroCartao').addEventListener('input', function (e) {
        const numeroCartao = e.target.value;
        const isValido = validarCartaoCredito(numeroCartao);

        // Mostrar ou ocultar o feedback
        const feedback = document.getElementById('numeroCartaoFeedback');
        if (feedback) {
            feedback.style.display = isValido ? 'none' : 'block';
        }
    });

    // Identificação do tipo de cartão
    function identificarTipoCartao(numeroCartao) {
        const numero = numeroCartao.replace(/\D/g, '');
        if (/^4[0-9]{0,15}$/.test(numero)) {
            return "Visa";
        } else if (/^5[1-5][0-9]{0,14}$/.test(numero)) {
            return "Mastercard";
        } else if (/^3[47][0-9]{0,13}$/.test(numero)) {
            return "American Express";
        } else if (/^6(?:011|5[0-9]{2})[0-9]{0,12}$/.test(numero)) {
            return "Discover";
        } else {
            return "Desconhecido";
        }
    }

    document.getElementById('numeroCartao').addEventListener('input', function (e) {
        const numeroCartao = e.target.value;
        const tipoCartao = identificarTipoCartao(numeroCartao);
        console.log(`Tipo do Cartão: ${tipoCartao}`);
    });
</script>
