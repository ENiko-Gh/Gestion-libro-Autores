<?php

namespace App\Models;

use PDO;

class Author
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function all()
    {
        $statement = $this->db->prepare("SELECT * FROM authors");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $statement = $this->db->prepare("SELECT * FROM authors WHERE id = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $statement = $this->db->prepare("
            INSERT INTO authors (name, bio) 
            VALUES (:name, :bio)
        ");
        $statement->bindParam(':name', $data['name']);
        $statement->bindParam(':bio', $data['bio']);
        return $statement->execute();
    }

    public function update($id, $data)
    {
        $statement = $this->db->prepare("
            UPDATE authors 
            SET name = :name, bio = :bio
            WHERE id = :id
        ");
        $statement->bindParam(':name', $data['name']);
        $statement->bindParam(':bio', $data['bio']);
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }

    public function delete($id)
    {
        $statement = $this->db->prepare("DELETE FROM authors WHERE id = :id");
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }
}
