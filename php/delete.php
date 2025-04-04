<?php
    session_start();
    include("config.php");

    $id = $_REQUEST['id'];

    $where = "idusuarios = '$id'";

    $db -> excluir($where);

    $_SESSION['delete'] = "Usuário excluído com sucesso!";
    header("Location: ../index.php");

    exit();

?>