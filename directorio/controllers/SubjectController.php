<?php

require_once("../services/SubjectService.php");
require_once("../repositories/SubjectRepository.php");

class SubjectController {
    private $service;

    public function __construct($conn) {
        $this->service = new SubjectService(new SubjectRepository($conn));
    }

    /**
     * Maneja la solicitud para obtener todos los usuarios.
     */
    public function getAllUsers() {
        try {
            $users = $this->service->getAllUsers();
            $usersArray = array_map(function($user) {
                return $user->toArray();
            }, $users);
    
            header("Content-Type: application/json");
            echo json_encode($usersArray);
            exit; 
        } catch (Exception $e) {
            header("Content-Type: application/json", true, 500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    /**
     * Maneja la solicitud para obtener un usuario por ID.
     *
     * @param int $id El ID del usuario a obtener.
     */
    public function getUserById($id) {
        try {
            $user = $this->service->getUserById($id);
            header("Content-Type: application/json");
            if ($user !== null) {
                echo json_encode($user);
            } else {
                header("HTTP/1.1 404 Not Found");
                echo json_encode(['message' => 'Usuario no encontrado', 'id' => $id]);
            }
        } catch (Exception $e) {
            header("Content-Type: application/json", true, 500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    /**
     * Maneja la solicitud para crear un nuevo usuario.
     */
    public function createUser() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);

            error_log('Datos recibidos: ' . print_r($data, true));

            if (isset($data['nombre'], $data['correo'], $data['telefono'])) {
                $result = $this->service->createUser($data['nombre'], $data['correo'], $data['telefono']);
                header('Content-Type: application/json');
                echo json_encode(['result' => $result]);
            } else {
                header('Content-Type: application/json', true, 400);
                echo json_encode(['error' => 'Datos incompletos']);
            }
        } catch (Exception $e) {
            header('Content-Type: application/json', true, 500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    /**
     * Maneja la solicitud para actualizar un usuario por ID.
     *
     * @param int $id El ID del usuario a actualizar.
     */
    public function updateUser($id) {
        
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            if ($data === null) {
                header('Content-Type: application/json', true, 400);
                echo json_encode(['error' => 'Datos incompletos']);
                return;
            }

            $existingUser = $this->service->getUserById($id);

            if (!$existingUser) {
                header('Content-Type: application/json', true, 404);
                echo json_encode(['error' => 'Usuario no encontrado']);
                return;
            }

            $nombre = $data['nombre'] ?? $existingUser->getNombre();
            $correo = $data['correo'] ?? $existingUser->getCorreo();
            $telefono = $data['telefono'] ?? $existingUser->getTelefono();

            $result = $this->service->updateUser($id, $nombre, $correo, $telefono);
            header('Content-Type: application/json');
            echo json_encode(['result' => $result]);
            
        } catch (Exception $e) {
            header('Content-Type: application/json', true, 500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    /**
     * Maneja la solicitud para eliminar un usuario por ID.
     *
     * @param int $id El ID del usuario a eliminar.
     */
    public function deleteUser($id) {
        try {
            if ($id !== null) {
                $result = $this->service->deleteUser($id);
                header('Content-Type: application/json');
                echo json_encode(['result' => $result]);
            } else {
                header('Content-Type: application/json', true, 400);
                echo json_encode(['error' => 'ID no proporcionado']);
            }
        } catch (Exception $e) {
            header('Content-Type: application/json', true, 500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
