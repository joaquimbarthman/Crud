<?php
    include("../classes/Db.class.php");
    include("../classes/Usuario.php");

    $db = new Db(); // Assume os parâmetros da classe
    $db -> conectar(); // Faz a conexão com o banco de dados
    $db -> setTabela("usuarios"); // Indica a tabela de banco que será utilizada

?>