<?php
include_once("Config/config.php");
include_once("Classes/CrudProduto.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $crud = new CrudProduto($db);

    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];

    if (isset($_FILES["imagens"]) && !empty($_FILES["imagens"]["name"][0])) {
        $imagens = $_FILES["imagens"];


        for ($i = 0; $i < count($imagens["name"]); $i++) {
            $nome_temporario = $imagens["tmp_name"][$i];
            $nome_arquivo = basename($imagens["name"][$i]);
            $caminho_destino = "uploads/" . $nome_arquivo;
            $tamanho_maximo = 2 * 1024 * 1024; // 2MB


            if (!file_exists("uploads")) {
                mkdir("uploads", 0777, true);
            }


            // Verificar o tipo de arquivo
            $tipo_permitido = ["image/jpeg", "image/png"];
            $tipo_arquivo = mime_content_type($nome_temporario);


            if (!in_array($tipo_arquivo, $tipo_permitido)) {
                echo "Erro: Tipo de arquivo não permitido. Apenas JPEG e PNG são aceitos." . "<br>";
                continue;
            }


            // Verificar o tamanho do arquivo
            if (filesize($nome_temporario) > $tamanho_maximo) {
                echo "Erro: O tamanho do arquivo '$nome_arquivo' excede 2MB." . "<br>";
                continue;
            }


            if (move_uploaded_file($nome_temporario, $caminho_destino)) {
                // Agora, você pode registrar o usuário após o loop
                $uploadSuccess = $crud->create($nome, $preco, $descricao, $caminho_destino, $categoria);

                echo "<br>Upload bem-sucedido e usuário registrado com sucesso!" . "<br>";
                echo 'Registro salvo com sucesso!!';
                header('refresh:3,produto.php');
            } else {
                echo "Erro ao mover o arquivo para o destino." . "<br>";
            }
        }


        exit();
    } else {
        echo "Erro: Nenhum arquivo de imagem foi enviado." . "<br>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadatro Produto</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadatro Produto</title>
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
            <form method="POST" enctype="multipart/form-data">
                <h2>Insira o nome do produto</h2>
                <input type="text" name="nome" placeholder="Insira o nome do produto" required>
                <h2>Insira preço</h2>
                <input type="decimal" name="preco" placeholder="Insira o preço" required>
                <h2>Insira descrição</h2>
                <input type="text" name="descricao" placeholder="Insira a descrição" required>


                <h2>Categoria</h2>

                <?php
                require_once("Classes/CrudCategoria.php");
                $cat = new CrudCategoria($db);
                $dados = $cat->read();

                echo "<select  name='categoria'>";
                echo "<option value=''> Selecione uma Categoria</option>";
                while ($linha = $dados->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=" . $linha['id'] . ">" . $linha['id'] . " - " . $linha['nomecategoria'] . "</option>";
                }
                echo "</select>";
                ?>

                <label for="imagens">
                    <h2>Insira foto do produto</h2>
                </label><br>
                <input type="file" name="imagens[]" id="imagens" accept="image/png,image/jpeg" multiple required>



                <div class="botao">
                    <input type="submit" value="Salvar">
                </div>
            </form>
          
        </main>
        <div class="boxDisc">
               <button><a href="logout.php">Desconectar Conta</a></button>
            </div>
        <footer>
            <a href=""><img src="./uploads/instagram.png" alt=""></a>
            <a href=""><img src="./uploads/facebook.png" alt=""></a>
            <h1>Siga as Redes do Site IdBit</h1>
        </footer>
    </body>

    </html>
</body>

</html>