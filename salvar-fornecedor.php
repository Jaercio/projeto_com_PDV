<?php

switch ($_REQUEST["acao"]){
    case 'cadastrar':
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);
        $cnpj = $_POST["cnpj"];
        $razao_soc = $_POST["razao_soc"];

        $sql = "INSERT INTO fornecedores (nome, email, senha, cnpj, razao_soc) VALUES 
                ('{$nome}', '{$email}','{$senha}','{$cnpj}', '{$razao_soc}')";

        $res = $conn->query($sql);

        if($res==true){
            print "<script>alert('Cadastrado Com Sucesso');</script>";
            print "<script>location.href='?page=listar-forn';</script>";
        }else{
            print "<script>alert('Não foi Possível Cadastrar');</script>";
            print "<script>location.href='?page=listar-forn';</script>";
        }

        break;

    case 'editar':
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);
        $cnpj = $_POST["cnpj"];
        $razao_soc = $_POST["razao_soc"];
        $sql = "UPDATE fornecedores SET nome='{$nome}',email='{$email}', 
                         senha='{$senha}',
                         razao_soc='{$razao_soc}', cnpj='{$cnpj}'
                         WHERE id=".$_REQUEST["id"];
        $res = $conn->query($sql);

        if($res==true){
            print "<script>alert('Editado Com Sucesso');</script>";
            print "<script>location.href='?page=listar-forn';</script>";
        }else{
            print "<script>alert('Não foi Possível Editar');</script>";
            print "<script>location.href='?page=listar-forn';</script>";
        }
        break;

    case 'excluir':
        $sql = "DELETE FROM fornecedores WHERE id=".$_REQUEST["id"];

        $res = $conn->query($sql);

        if($res==true){
            print "<script>alert('Excluido Com Sucesso');</script>";
            print "<script>location.href='?page=listar-forn';</script>";
        }else{
            print "<script>alert('Não foi Possível Excluir');</script>";
            print "<script>location.href='?page=listar-forn';</script>";
        }
        break;
    default:


}