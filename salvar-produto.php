<?php

switch ($_REQUEST["acao"]){
    case 'cadastrar':
        $descri = $_POST["nome"];
        $preco = $_POST["preco"];
        $qtdd = $_POST["estoque"];

        $sql = "INSERT INTO produtos (nome, preco, estoque) VALUES 
                ('{$descri}','{$preco}','{$qtdd}')";

        $res = $conn->query($sql);

        if($res==true){
            print "<script>alert('Cadastrado Com Sucesso');</script>";
            print "<script>location.href='?page=listar-prod';</script>";
        }else{
            print "<script>alert('Não foi Possível Cadastrar');</script>";
            print "<script>location.href='?page=listar-prod';</script>";
        }

        break;

    case 'editar':
        $descri = $_POST["nome"];
        $preco = $_POST["preco"];
        $qtdd = $_POST["estoque"];
        $sql = "UPDATE produtos SET nome='{$descri}',
                         preco='{$preco}',
                         estoque='{$qtdd}'
                         WHERE id=".$_REQUEST["id"];
        $res = $conn->query($sql);

        if($res==true){
            print "<script>alert('Editado Com Sucesso');</script>";
            print "<script>location.href='?page=listar-prod';</script>";
        }else{
            print "<script>alert('Não foi Possível Editar o produto');</script>";
            print "<script>location.href='?page=listar-prod';</script>";
        }
        break;

    case 'excluir':
        $sql = "DELETE FROM produtos WHERE id=".$_REQUEST["id"];

        $res = $conn->query($sql);

        if($res==true){
            print "<script>alert('Excluido Com Sucesso');</script>";
            print "<script>location.href='?page=listar-prod';</script>";
        }else{
            print "<script>alert('Não foi Possível Excluir o produto');</script>";
            print "<script>location.href='?page=listar-prod';</script>";
        }
        break;
    default:

}
?>