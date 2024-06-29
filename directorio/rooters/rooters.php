<?php
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    exit(0); // Termina la ejecución para OPTIONS
}

// Configuración de la conexión a la base de datos
$conn = require_once('../config.php');
require_once('../controllers/SubjectController.php');

// Crear una instancia del controlador con la conexión de base de datos
$controller = new SubjectController($conn);

// Obtener el método de la solicitud HTTP (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];


// Obtener la URI y descomponerla en partes
// $uri = str_replace('/directorio/rooters/rooters.php', '',$_SERVER['REQUEST_URI']);
// $uriParts = explode('/', trim($uri, '/'));

// Obtener la ruta relativa después de '/rooters/'
$path = str_replace('/directorio/rooters/rooters.php', '', $_SERVER['REQUEST_URI']);
$uriParts = explode('/', trim($path, '/'));

// Inicializar ID como null
$id = null;

// Extraer el ID si está presente en la URI

if (isset($uriParts[0]) && is_numeric($uriParts[0])) {
    $id = (int)$uriParts[0];
}
// Ejecutar el método correspondiente del controlador basado en el método HTTP
switch ($method) {
    case 'GET':
        if ($id !== null) {
            $controller->getUserById($id); // Obtener usuario por ID
        } else {
            $controller->getAllUsers(); // Obtener todos los usuarios
        }
        break;

    case 'POST':
        // Crear un nuevo usuario
        $controller->createUser();
        break;

    case 'PUT':
        // Actualizar un usuario
        if ($id !== null) {
            $controller->updateUser($id);
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(['error' => 'ID de usuario no proporcionado']);
        }
        break;

    case 'DELETE':
        // Eliminar un usuario
        if ($id !== null) {
            $controller->deleteUser($id);
        } else {
            header('Content-Type: application/json', true, 400);
            echo json_encode(['error' => 'ID de usuario no proporcionado']);
        }
        break;

    default:
        // Método no permitido
        header('HTTP/1.1 405 METHOD Not Allowed');
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
