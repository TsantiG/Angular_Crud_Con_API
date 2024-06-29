<?php
declare(strict_types=1);

require_once '../repositories/SubjectRepository.php';

class SubjectService {
    private SubjectRepository $repository;

    public function __construct(SubjectRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * Crea un nuevo usuario.
     *
     * @param string $nombre
     * @param string $correo
     * @param string $telefono
     * @return int|false El ID del nuevo usuario o false en caso de error
     * @throws InvalidArgumentException Si los datos no son válidos
     */
    public function createUser(string $nombre, string $correo, string $telefono) {
        // Validar entrada (puedes agregar más validaciones según tus necesidades)
        // if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        //     throw new InvalidArgumentException("Correo no válido.");
        // }

        // Crear un modelo de usuario
        $user = new SubjectModel(null, $nombre, $correo, $telefono);
        return $this->repository->create($user);
    }

    /**
     * Obtiene todos los usuarios.
     *
     * @return array Lista de usuarios
     */
    public function getAllUsers(): array {
        return $this->repository->read();
    }

    /**
     * Obtiene un usuario por su ID.
     *
     * @param int $id
     * @return SubjectModel|null El usuario o null si no se encuentra
     */
    public function getUserById(int $id): ?SubjectModel {
        return $this->repository->findById($id);
    }

    /**
     * Actualiza un usuario.
     *
     * @param int $id
     * @param string|null $nombre
     * @param string|null $correo
     * @param string|null $telefono
     * @return bool true si la actualización fue exitosa, false en caso contrario
     */
    public function updateUser(int $id, ?string $nombre, ?string $correo, ?string $telefono): bool {
        $user = new SubjectModel($id, $nombre, $correo, $telefono);
        return $this->repository->update($user);
    }

    /**
     * Elimina un usuario por su ID.
     *
     * @param int $id
     * @return bool true si la eliminación fue exitosa, false en caso contrario
     */
    public function deleteUser(int $id): bool {
        return $this->repository->delete($id);
    }
}
