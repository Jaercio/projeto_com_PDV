<?php

switch ($_REQUEST["acao"]){
    case 'cadastrar':
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);
        $data_nasc = $_POST["data_nasc"];
        $tipo = $_POST["tipo"];

        $sql = "INSERT INTO usuarios (nome, email, senha, data_nasc, tipo) VALUES 
                ('{$nome}', '{$email}','{$senha}','{$data_nasc}', '{$tipo}')";

        $res = $conn->query($sql);

        if($res==true){
            print "<script>alert('Cadastrado Com Sucesso');</script>";
            print "<script>location.href='?page=listar';</script>";
        }else{
            print "<script>alert('Não foi Possível Cadastrar');</script>";
            print "<script>location.href='?page=listar';</script>";
        }

        break;

        case 'editar':
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $senha = md5($_POST["senha"]);
            $data_nasc = $_POST["data_nasc"];
            $tipo = $_POST["tipo"];
$sql = "UPDATE usuarios SET nome='{$nome}',email='{$email}', 
                         senha='{$senha}',
                         data_nasc='{$data_nasc}', tipo='{$tipo}'
                         WHERE id=".$_REQUEST["id"];
            $res = $conn->query($sql);

            if($res==true){
                print "<script>alert('Editado Com Sucesso');</script>";
                print "<script>location.href='?page=listar';</script>";
            }else{
                print "<script>alert('Não foi Possível Editar');</script>";
                print "<script>location.href='?page=listar';</script>";
            }
        break;

        case 'excluir':
        $sql = "DELETE FROM usuarios WHERE id=".$_REQUEST["id"];

            $res = $conn->query($sql);

            if($res==true){
                print "<script>alert('Excluido Com Sucesso');</script>";
                print "<script>location.href='?page=listar';</script>";
            }else{
                print "<script>alert('Não foi Possível Excluir');</script>";
                print "<script>location.href='?page=listar';</script>";
            }
        break;
    default:
        throw new \Exception('Unexpected value');

}