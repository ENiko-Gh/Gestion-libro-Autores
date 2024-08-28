<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Gestión de Autores</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Gestión de Autores</h1>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createAuthorModal">Agregar Autor</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($authors as $author): ?>
                    <tr>
                        <td><?php echo $author['id']; ?></td>
                        <td><?php echo $author['name']; ?></td>
                        <td>
                            <button class="btn btn-info btn-edit" data-id="<?php echo $author['id']; ?>" data-toggle="modal" data-target="#editAuthorModal">Editar</button>
                            <button class="btn btn-danger btn-delete" data-id="<?php echo $author['id']; ?>">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para crear autor -->
    <div class="modal fade" id="createAuthorModal" tabindex="-1" aria-labelledby="createAuthorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAuthorModalLabel">Agregar Nuevo Autor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createAuthorForm">
                        <div class="form-group">
                            <label for="authorName">Nombre</label>
                            <input type="text" class="form-control" id="authorName" name="name" required>
                        </div>
 
