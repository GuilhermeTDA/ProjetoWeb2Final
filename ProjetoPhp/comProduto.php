<?php
include_once 'config/config.php';
include_once 'classes/CrudProduto.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $crud = new CrudProduto($db);
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $imagem = $_POST['imagem'];
    $categoria = $_POST['categoria'];

    $crud->create($nome, $preco, $descricao, $imagem, $categoria);
    echo 'editado com sucesso';
    header('refresh:2,produto.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $crud = new CrudProduto($db);
    $data = $crud->readEdit($id);
    $row = $data->FETCH(PDO::FETCH_ASSOC);
    header('refresh:2,produto.php');
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/comPro.css">
    <title>Compra</title>
    

</head>


<body>
    <div class="boxCom">
        <h1>COMPRA PRODUTO</h1>


        <h1> <?php echo $row['nome']; ?> </h1>
        <h1> <?php echo $row['preco']; ?> </h1>
        <h2> <?php echo $row['descricao']; ?> </h2>
        <h1> <img src="<?php echo $row['imagem']; ?>." width="120px;" height="120px;" alt="Image" /> </h1>

    </div>

</body>

</html>