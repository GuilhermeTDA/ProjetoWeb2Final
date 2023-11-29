<?php
include_once("Config/config.php");
include_once("Classes/CrudRel.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $crud = new CrudRel($db);
    $fkproduto = $_POST['produto'];
    $fkusuario = $_POST['usuario'];
    $fkfeedback = $_POST['feedback'];


    $crud->create($fkusuario, $fkfeedback, $fkproduto);
    echo 'Registro salvo com sucesso!!';
    header('refresh:3,produto.php');
    exit();
} ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/relacionamento.css">
    <title>Relacionamentos</title>
</head>

<header>
    <img src="./uploads/idBitNew.jpeg" alt="">
    <h1>IdBit</h1>
    <ul>

        <li><a href="./produto.php">Home</a></li>
        <li><a href="./index.php">Login</a></li>
        <li><a href="./cadUsu.php">Cadastro</a></li>
        <li><a href="./feedback.php">FeedBack</a></li>
        <li><a href="./cadProduto.php">Vender</a></li>
        <li><a href="./relacionamentos.php">Relacionamentos</a></li>

    </ul>
</header>

<body>

    <main class="container">
        <h2 class="h2text">TELA CADASTRO DE RELACIONAMENTOS</h2>
        <form method="POST">

            <?php
            require_once("Classes/CrudFeedback.php");
            require_once("Classes/CrudProduto.php");
            require_once("Classes/Crud.php");

            $feedback = new CrudFeedback($db);
            $dadosf = $feedback->read();

            $produto = new CrudProduto($db);
            $dadosp = $produto->read();

            $usuario = new Crud($db);
            $dadosu = $usuario->read();

            echo "<select name='feedback'>";
            echo "<option> Selecione um Feedback</option>";
            while ($linha = $dadosf->fetch(PDO::FETCH_ASSOC)) {

                echo "<option name='feedback' value=" . $linha['id'] . ">" . $linha['id'] . " - " . $linha['nome'] . "</option>";
            }
            echo "</select>";


            echo "<select name='produto'>";
            echo "<option> Selecione um Produto</option>";
            while ($linha = $dadosp->fetch(PDO::FETCH_ASSOC)) {

                echo "<option name='produto' value=" . $linha['id'] . ">" . $linha['id'] . " - " . $linha['nome'] . "</option>";
            }
            echo "</select>";
            echo "<select name='usuario'>";
            echo "<option> Selecione um Usuario</option>";
            while ($linha = $dadosu->fetch(PDO::FETCH_ASSOC)) {

                echo "<option name='usuario' value=" . $linha['id'] . ">" . $linha['id'] . " - " . $linha['nome'] . "</option>";
            }
            echo "</select>";
            ?>

            <input type="submit" value="salvar">
        </form>


    </main>
</body>
<div class="boxDisc">
    <button><a href="logout.php">Desconectar Conta</a></button>
</div>
<footer>
    <a href=""><img src="./uploads/instagram.png" alt=""></a>
    <a href=""><img src="./uploads/facebook.png" alt=""></a>
    <h1>Siga as Redes do Site IdBit</h1>
</footer>
</body>