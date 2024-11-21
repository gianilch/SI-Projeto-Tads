<div class="container mt-5">
    <h2>Visualizar Usuário</h2>
    <form action="?page=salvar" method="POST">
        <!-- Campo oculto para enviar o ID do usuário -->
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>" disabled>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $usuario['email']; ?>" disabled>
        </div>
    </form>
    <button type="button" class="btn btn-info" onclick="window.location.href='?page=listar'">Voltar</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='?page=editar&id=<?php echo $usuario['id']; ?>'">Atualizar</button>
</div>
