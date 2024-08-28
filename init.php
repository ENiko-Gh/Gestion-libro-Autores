<?php
// app/init.php

// Cargar automáticamente las clases del proyecto
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/Controllers/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    } else {
        $file = __DIR__ . '/Models/' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

// Incluir otros archivos necesarios
require_once __DIR__ . '/../config/database.php';
require_once 'router.php';
