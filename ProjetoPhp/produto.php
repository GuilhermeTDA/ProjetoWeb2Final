<?php
include_once 'config/config.php';
include_once 'classes/CrudProduto.php';
$crud = new CrudProduto($db);
$data = $crud->read();

if (isset($_POST['buscar'])) {
    $busca = $_POST['nome'];
    $data = $crud->readCat($busca);}



?>

<!DOCTYPE html>
<html>

<head>

    <title>Produto</title>
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


    <div class="search">
        
        <form method="POST">
       

            <input type="text" name="nome">
            <input type="submit" value="Pesquisar" name="buscar">
        </form>

    </div>
    <div class="organizar">


        <?php

        while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <div class="box">
                <img src="<?php echo $row['imagem']; ?>." width="80px;" height="80px;" alt="Image" />
                <?php echo "<h3> " . $row['nome'] . " </h3> " ?>
                <?php echo "<h2> R$ " . $row['preco'] . " </h2> " ?>

                <button><a href="comProduto.php?id=<?php echo $row['id']; ?>"> Comprar</a></button>
            </div>
           
        <?php } ?>

       

    </div>
    <div class="boxDisc">
               <button><a href="logout.php">Desconectar Conta</a></button>
            </div>
    <footer><img src="./uploads/instagram.png" alt="">
        <img src="./uploads/facebook.png" alt="">
        <h1>Siga as Redes do Site IdBit</h1>
    </footer>
</body>

</html>