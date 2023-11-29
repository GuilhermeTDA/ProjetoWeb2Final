<?php
class CrudRel
{
    private $conn;
    private $table_name = "tbrelacionamentos";

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function create($fkusuario,$fkfeedback,$fkproduto)
    {
        $query = "INSERT INTO " . $this->table_name . " (fkusuario,fkfeedback,fkproduto ) VALUES (?,?,?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$fkusuario, $fkfeedback,$fkproduto]);
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
    public function update($id, $fkproduto, $fkfeedback, $fkusuario)
    {
        $query = "UPDATE " . $this->table_name . " SET fkproduto = ? fkfeedback = ? fkusuario = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$fkproduto,  $fkfeedback, $fkusuario, $id]);
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
