<?php
include_once("./Config/config.php");
include_once("./Classes/CrudFeedback.php");
$crudFeedback = new CrudFeedback($db);
$data = $crudFeedback->read();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $crud = new CrudFeedback($db);
    $nome = $_POST['nome'];
    $feedback = $_POST['feed'];
    $crud->create($nome, $feedback);
    echo 'Registro salvo com sucesso!!';
    header('refresh:3,produto.php');
    exit();
} ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadatro</title>
    <link rel="stylesheet" href="./css/feed.css">
</head>

<body>
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
    <main class="container">
        <form method="POST">
            <div class="fundoForm">
                <h4>Seu Apelido</h4>
                <input type="text" name="nome" placeholder="Insira o seu nome " required><br>

                <h4>O que achou do site?</h4>

                <input type="text" name="feed" placeholder="Insira o eu Feedback " required><br><br>

                <input type="submit" id="botaofeed" value="Feedback">
            </div>

        </form>
        <div class="org">
            <?php


            while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
            ?>

                <div class="opiniao">

                    <?php echo $row['nome'] . ":"; ?>
                    <?php echo $row['feedback']; ?>


                </div>

            <?php } ?>
        </div>
    </main>
    <div class="boxDisc">
               <button><a href="logout.php">Desconectar Conta</a></button>
            </div>
    <footer>
        <img src="./uploads/instagram.png" alt="">
        <img src="./uploads/facebook.png" alt="">
        <h1>Siga as Redes do Site IdBit</h1>
    </footer>
</body>

</html>