<?php
class CrudProduto
{
    private $conn;
    private $table_name = "tbproduto";
    
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function create($nome, $preco, $descricao ,$imagens, $categoria)
    {
      
        $query = "INSERT INTO " . $this->table_name . " (nome, preco, descricao, imagem, categoriaid)
         VALUES (?,?,?,?,?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nome, $preco, $descricao ,$imagens, $categoria]);
        return $stmt;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function readEdit($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;
    }

    public function readCat($nome)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE nome LIKE :nome";
        $stmt = $this->conn->prepare($query);
        $nome = $nome . '%';
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
        
    }

    public function update($id, $nome , $preco, $descricao ,$imagens, $categoria)
    {
        $query = "UPDATE " . $this->table_name . " SET nome = ? preco = ? descricao = ? imagens = ? categoriaid = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nome,  $preco, $descricao ,$imagens, $id, $categoria]);
        return $stmt;
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    }
}