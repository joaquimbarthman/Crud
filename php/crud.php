<?php
    session_start();
    include("config.php");

    $formulario = file_get_contents("../html/formulario.html");

    $cadastro = true;

    $dados_db = $db -> consultar('*');

    if (isset($_REQUEST['id'])) {
        $cadastro = false;
    }

    $nome = $email = $cpf = $celular = $senha = $confirme = $id = "";
    $operacao = 1; 
    $acao = "create.php";

    if (!$cadastro) { 
        $dados = encontrar_dados($_REQUEST['id'], $dados_db);   
        $cpf = $dados["cpf"];
        $nome = $dados["nome"];
        $celular = $dados["celular"];
        $email = $dados["email"];
        $id = $dados["idusuarios"];
        $acao = "update.php";
        $operacao = 2;
    }

    if (isset($_SESSION['erro'])) {
        echo "<div class='popup erro' id='erro'>
                <h2>" . $_SESSION['erro'] . "</h2> 
                <button onclick=\"fechar(this)\">
                    <img src='../icon/fechar.png'>
                </button>
              </div>";
        unset($_SESSION['erro']);
    }
    
    if (isset($_SESSION['create'])) {
        echo "<div class='popup check' id='create'>
                <h2>" . $_SESSION['create'] . "</h2> 
                <button onclick=\"fechar(this)\">
                    <img src='../icon/fechar.png'>
                </button>
              </div>";
        unset($_SESSION['create']);
    }
    
    if (isset($_SESSION['update'])) {
        echo "<div class='popup check' id='update'>
                <h2>" . $_SESSION['update'] . "</h2> 
                <button onclick=\"fechar(this)\">
                    <img src='../icon/fechar.png'>
                </button>
              </div>";
        unset($_SESSION['update']);
    }

    function encontrar_dados($id, $dados_db){
        $dados = [];
        foreach ($dados_db as $usuario) {
            if ($usuario['idusuarios'] == $id) {
                $dados = $usuario;
                break;
            }
        }
        return $dados;
    }

    $pagina = preencher($nome, $email, $cpf, $celular, $senha, $confirme, $id, $operacao, $formulario, $acao);

    function preencher($nome, $email, $cpf, $celular, $senha, $confirme, $id, $operacao, $formulario, $acao) {
        $pagina = $formulario;
        $pagina = str_replace("#nome", $nome, $pagina);
        $pagina = str_replace("#email", $email, $pagina);
        $pagina = str_replace("#cpf", $cpf, $pagina);
        $pagina = str_replace("#celular", $celular, $pagina);
        $pagina = str_replace("#senha", $senha, $pagina);
        $pagina = str_replace("#confirme", $confirme, $pagina);
        $pagina = str_replace("#id", $id, $pagina);
        $pagina = str_replace("#operacao", $operacao, $pagina);
        $pagina = str_replace("#acao", $acao, $pagina);
        $pagina = str_replace("#botao", "Enviar", $pagina);
        return $pagina;
    }

    echo $pagina;
?>