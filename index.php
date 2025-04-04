<?php
    session_start(); 

    include("classes/Db.class.php");
    include("classes/Usuario.php");

    $db = new Db(); // Assume os parâmetros da classe
    $db -> conectar(); // Faz a conexão com o banco de dados
    $db -> setTabela("usuarios"); // Indica a tabela de banco que será utilizada


    if (isset($_SESSION['delete'])) {
        echo "<div class='popup' id='mensagem-index'>
                <h2>" . $_SESSION['delete'] . "</h2> <button onclick='fechar()'><img src='icon/fechar.png'></button>
            </div>";
        
        unset($_SESSION['delete']); 
    }


    $dados_db = $db -> consultar('*'); 

    $pagina = file_get_contents("html/tabela.html");

    if (!empty($dados_db)) {
        $tabelaHtml = "<table id='tabela'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CPF</th>
                        <th>NOME</th>
                        <th>CELULAR</th>
                        <th>EMAIL</th>
                        <th>ALTERAÇÃO</th>
                    </tr>
                </thead>
                <tbody>"; 

        foreach ($dados_db as $usuario) {
            $id = htmlspecialchars($usuario['idusuarios']);
            $cpf = htmlspecialchars($usuario['cpf']);
            $nome = htmlspecialchars($usuario['nome']);
            $celular = htmlspecialchars($usuario['celular']);
            $email = htmlspecialchars($usuario['email']);
            $tabelaHtml .= "<tr>
                <td>{$id}</td>
                <td>{$cpf}</td>
                <td>{$nome}</td>
                <td>{$celular}</td>
                <td>{$email}</td>
                <td>
                    <div class='botoes'>
                        <a class='botao editar' href='php/crud.php?id={$id}'><img src='icon/lapis.png'></a>
                        <a class='botao excluir' href='php/delete.php?id={$id}'><img src='icon/lixeira.png'></a>
                    </div>
                </td>
            </tr>";
        }

        $tabelaHtml .= "</tbody></table>"; 

        $pagina = str_replace("#tabela", $tabelaHtml, $pagina);
        echo $pagina;

    } else {
        $pagina = str_replace("#tabela", "<div class='erro'><img src='icon/erro.gif'><h2> Nenhum usuário encontrado! </h2></div>", $pagina);
        echo $pagina;
    }
?>
