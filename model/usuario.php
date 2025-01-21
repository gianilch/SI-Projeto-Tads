<?php

function salvarUsuario($conexao, $nome, $email, $senha, $id = null): mixed
{
    if ($id) {
        if (!empty($senha)) {
            $sql = "UPDATE usuario SET nome = ?, email = ?, senha = ? WHERE id = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("sssi", $nome, $email, $senha, $id);
        } else {
            $sql = "UPDATE usuario SET nome = ?, email = ? WHERE id = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("ssi", $nome, $email, $id);
        }
    } else {
        $sql = "INSERT INTO usuario(nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $senha);
    }
    return $stmt->execute();
}

function excluirUsuario($conexao, $id)
{
    $sql = "DELETE FROM usuario WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);

    return $stmt->execute();
}

function getUsuario($conexao, $id)
{
    $sql = "SELECT * FROM usuario WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

?>