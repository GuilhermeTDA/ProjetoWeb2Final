<?php
session_start();
include './config/config.php';
include 'user.php';


$user = new User($db);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];


    if ($user->login($username, $password)) {
        header("Location: produto.php");
        exit();
    } else {
        echo "Login falhou. Verifique suas credenciais.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">

</head>

<body>
    <header>
    <img src="./uploads/idBitNew.jpeg" alt="">
        <h1>IdBit</h1>
        <ul>

            <li>Home</li>
            <li>Login</li>
            <li><a href="./cadUsu.php">Cadastro</a></li>
            <li>FeedBack</li>
            <li>Vender</li>
            <li>Relacionamnetos</li>

        </ul>
    </header>
    <main class="container">

        <form method="post" action="">
            <label for="username">Email:</label>
            <input type="text" name="username" required><br>


            <label for="password">Senha:</label>
            <input type="password" name="password" required><br>

            <div class="botao">
                <input type="submit" value="Login">
                <a href="cadUsu.php">Não tem cadastro, Clique aqui!!</a>
            </div>
        </form>
    </main>
    
    <footer><img src="./uploads/instagram.png" alt="insta">
        <img src="./uploads/facebook.png" alt="Face">
        <h1>Siga as Redes do Site IdBit</h1>
    </footer>
</body>

</html>