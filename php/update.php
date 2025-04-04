<?php
    session_start();
    include("config.php");

    $id = $_REQUEST['id'];  
    $nome = $_REQUEST['nome'];  
    $email = $_REQUEST['email'];
    $login = $_REQUEST['email'];
    $cpf = $_REQUEST['cpf'];
    $celular = $_REQUEST['celular'];
    $senha = $_REQUEST['senha'];
    $confirme = $_REQUEST['confirme'];

    $dados_db = $db -> consultar('*');
    
    $celular_formatada = preg_replace("/(\d{2})(\d{5})(\d{4})/", "($1)$2$3", $celular);
    
    $criptografia = md5($senha);

    print_r($dados_db);
       
    foreach ($dados_db as $usuario) {
        if ($usuario['email'] == $email && $usuario['idusuarios'] != $id) {
            $_SESSION['erro'] = "Esse E-mail já pertence a outro usuário!";
            header("Location: crud.php"); 
            exit; 
        }
    }

    foreach ($dados_db as $usuario) {
        if ($usuario['cpf'] == $cpf && $usuario['idusuarios'] != $id) {
            $_SESSION['erro'] = "Esse CPF já pertence a outro usuário!";
            header("Location: crud.php"); 
            exit; 
        }
    }


    if ($senha != $confirme) {
        $_SESSION['erro'] = "As senhas não coincidem.";
        header("Location: crud.php");
        exit;
    }

    $update = [
        'cpf' => $cpf,
        'nome' => $nome,
        'celular' => $celular_formatada,
        'email' => $email,
        'login' => $login,
        'senha' => $criptografia
    ];
    
    $where = "idusuarios = '$id'";

    $db -> alterar($where, $update);

    $_SESSION['update'] = "Credencias atualizadas com sucesso!";
    header("Location: crud.php");
    exit;
?>