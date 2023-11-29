<?php
include_once("Config/config.php");
include_once("Classes/Crud.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $crud = new Crud($db);
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $senha = $_POST['senha'];
    $crud->create($nome, $email, $endereco, $senha,);
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
    <link rel="stylesheet" href="./css/style.css">

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
            <h2>Nome:</h2>
            <input type="text" name="nome" placeholder="Insira o nome " required>
            <h2>Email:</h2>
            <input type="email" name="email" placeholder="Insira o email " required>
            <h2>Endereço:</h2>
            <input type="text" name="endereco" placeholder="Insira o endereço " required>
            <h2>Senha:</h2>
            <input type="password" name="senha" placeholder="Insira a Senha " required>
            <div class="botao">
                <input type="submit" value="Cadastrar!">
            </div>
        </form>
    </main>
    <div class="boxDisc">
               <button><a href="logout.php">Desconectar Conta</a></button>
            </div>
    <footer><img src="./uploads/instagram.png" alt="">
        <img src="./uploads/facebook.png" alt="">
        <h1>Siga as Redes do Site IdBit</h1>
    </footer>
</body>

</html>