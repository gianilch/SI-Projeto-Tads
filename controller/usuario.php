<?php

include("../model/banco.php");
include("../model/usuario.php");
include("../view/template.php");

switch (@$_REQUEST["page"]) {
    case "novo":
        include("../view/cadastrar_usuario.php");
        break;
    case "listar":
        include("../view/listar_usuarios.php");
        break;
    case "visualizar":
        $id = intval($_REQUEST['id']);
        $usuario = getUsuario($conexao, $id);
        include("../view/visualizar_usuario.php");
        break;
    case "salvar":
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $id = isset($_POST['id']) && !empty($_POST['id']) ? intval($_POST['id']) : null;

        if (salvarUsuario($conexao, $nome, $email, $senha, $id)) {
            echo "<script>alert('Usuário " . ($id ? "atualizado" : "cadastrado") . " com sucesso'); </script>";
        } else {
            echo "<script>alert('Não foi possível " . ($id ? "atualizar" : "cadastrar") . " o usuário.'); </script>";

        }
        echo "<script>location.href='?page=listar';</script>";
        break;
    case "editar":
        $id = intval($_REQUEST['id']);
        $usuario = getUsuario($conexao, $id);
        include("../view/editar_usuario.php");
        break;
    case "excluir":
        $id = intval($_REQUEST['id']);
        if (excluirUsuario($conexao, $id)) {
            echo "<script>alert('Usuário excluído com sucesso.'); </script>";
        } else {
            echo "<script>alert('Não foi possível excluir o usuário.'); </script>";
        }
        echo "<script>location.href='?page=listar';</script>";
        break;
    default:
        break;

}

?>