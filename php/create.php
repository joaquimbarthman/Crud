<?php
    session_start();
    include("./config.php");
    
    $nome = $_REQUEST['nome'];  
    $email = $_REQUEST['email'];
    $login = $_REQUEST['email'];
    $cpf = $_REQUEST['cpf'];
    $celular = $_REQUEST['celular'];
    $senha = $_REQUEST['senha'];
    $confirme = $_REQUEST['confirme'];

    $dados_db = $db -> consultar('*'); 

    $celular_formatada = preg_replace("/(\d{2})(\d{5})(\d{4})/", "($1)$2$3", $celular);

    foreach ($dados_db as $usuarios) {
        if ($usuarios['email'] == $email) {
            $_SESSION['erro'] = "Esse E-mail já existe!";
            header("Location: crud.php");
            exit;
        }
    }

    foreach ($dados_db as $usuarios) {
        if ($usuarios['cpf'] == $cpf) {
            $_SESSION['erro'] = "Esse CPF já existe!";
            header("Location: crud.php");
            exit;
        }
    }

    if ($senha != $confirme) {
        $_SESSION['erro'] = "As senhas não coincidem.";
        header("Location: crud.php");
        exit;
    }

    $criptografia = md5($senha);
    $usuario = new Usuario( $cpf, $nome, $celular_formatada, $email , $login, $criptografia);
    $usuario -> gravar($db);


    $_SESSION['create'] = "Usuário criado com sucesso!";
    header("Location: crud.php");
    exit;


?>