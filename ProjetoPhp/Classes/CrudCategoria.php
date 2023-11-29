<?php
class CrudCategoria
{
    private $conn;
    private $table_name = "tbcategoria";
    
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function create($nome)
    {
      
        $query = "INSERT INTO " . $this->table_name . " (nomecategoria) VALUES (?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nome]);
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
    public function update($id, $nome )
    {
        $query = "UPDATE " . $this->table_name . " SET nomecategoria = ?   WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nome, $id]);
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