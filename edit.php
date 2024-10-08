<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Editar Autor</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Autor</h1>
        <form id="editAuthorForm" method="POST" action="/gestion_libros_autores/public/authors/edit/<?php echo $author['id']; ?>">
            <div class="form-group">
                <label for="authorName">Nombre</label>
                <input type="text" class="form-control" id="authorName" name="name" value="<?php echo $author['name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
