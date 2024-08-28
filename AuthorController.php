<?php

namespace App\Controllers;

use App\Models\Author;
use PDO;

class AuthorController
{
    private $author;

    public function __construct($database)
    {
        $this->author = new Author($database);
    }

    public function index()
    {
        try {
            $authors = $this->author->all();
            require_once __DIR__ . '/../Views/authors/index.php';
        } catch (\Exception $e) {
            echo "Error al obtener los autores: " . $e->getMessage();
        }
    }

    public function create($data)
    {
        // Validación básica de datos
        if (isset($data['name']) && !empty($data['name'])) {
            try {
                $this->author->create($data);
                header('Location: /authors');
                exit; // Asegurarse de que el script se detiene después de la redirección
            } catch (\Exception $e) {
                echo "Error al crear el autor: " . $e->getMessage();
            }
        } else {
            echo "El nombre del autor es requerido.";
        }
    }

    public function edit($id)
    {
        try {
            $author = $this->author->find($id);
            if ($author) {
                require_once __DIR__ . '/../Views/authors/edit.php';
            } else {
                echo "Autor no encontrado.";
            }
        } catch (\Exception $e) {
            echo "Error al obtener el autor: " . $e->getMessage();
        }
    }

    public function update($id, $data)
    {
        // Validación básica de datos
        if (isset($data['name']) && !empty($data['name'])) {
            try {
                $this->author->update($id, $data);
                header('Location: /authors');
                exit; // Asegurarse de que el script se detiene después de la redirección
            } catch (\Exception $e) {
                echo "Error al actualizar el autor: " . $e->getMessage();
            }
        } else {
            echo "El nombre del autor es requerido.";
        }
    }

    public function delete($id)
    {
        try {
            $this->author->delete($id);
            header('Location: /authors');
            exit; // Asegurarse de que el script se detiene después de la redirección
        } catch (\Exception $e) {
            echo "Error al eliminar el autor: " . $e->getMessage();
        }
    }
}
