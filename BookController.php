<?php
require_once '../config/database.php';
require_once '../app/Models/Book.php';

class BookController {
    private $db;
    private $model;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->model = new Book($this->db);
    }

    public function index() {
        try {
            $result = $this->model->readAll();
            require_once '../app/Views/books/index.php';
        } catch (Exception $e) {
            echo "Error al obtener los libros: " . $e->getMessage();
        }
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validación básica de datos
            if (isset($_POST['title']) && isset($_POST['author_id'])) {
                $this->model->title = htmlspecialchars(strip_tags($_POST['title']));
                $this->model->author_id = htmlspecialchars(strip_tags($_POST['author_id']));
                
                try {
                    if ($this->model->create()) {
                        header('Location: /gestion_libros_autores/public/books');
                        exit; // Asegurar que el script se detiene después de la redirección
                    } else {
                        echo "Error al crear el libro.";
                    }
                } catch (Exception $e) {
                    echo "Error al crear el libro: " . $e->getMessage();
                }
            } else {
                echo "Faltan datos necesarios.";
            }
        } else {
            require_once '../app/Views/books/create.php';
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validación básica de datos
            if (isset($_POST['title']) && isset($_POST['author_id'])) {
                $this->model->id = $id;
                $this->model->title = htmlspecialchars(strip_tags($_POST['title']));
                $this->model->author_id = htmlspecialchars(strip_tags($_POST['author_id']));
                
                try {
                    if ($this->model->update()) {
                        header('Location: /gestion_libros_autores/public/books');
                        exit; // Asegurar que el script se detiene después de la redirección
                    } else {
                        echo "Error al actualizar el libro.";
                    }
                } catch (Exception $e) {
                    echo "Error al actualizar el libro: " . $e->getMessage();
                }
            } else {
                echo "Faltan datos necesarios.";
            }
        } else {
            try {
                $book = $this->model->readOne($id);
                require_once '../app/Views/books/edit.php';
            } catch (Exception $e) {
                echo "Error al obtener los datos del libro: " . $e->getMessage();
            }
        }
    }

    public function delete($id) {
        try {
            $this->model->id = $id;
            if ($this->model->delete()) {
                header('Location: /gestion_libros_autores/public/books');
                exit; // Asegurar que el script se detiene después de la redirección
            } else {
                echo "Error al eliminar el libro.";
            }
        } catch (Exception $e) {
            echo "Error al eliminar el libro: " . $e->getMessage();
        }
    }
}
