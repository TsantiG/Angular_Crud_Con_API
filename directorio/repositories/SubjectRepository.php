<?php

require_once("../models/subjectModel.php");

/**
 * Repositorio para gestionar la tabla user1
 */
class SubjectRepository {
    private PDO $conn;

    /**
     * Constructor que inyecta la conexión de base de datos.
     * 
     * @param PDO $conn
     */
    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    /**
     * Crea un nuevo registro en la tabla user1.
     * 
     * @param SubjectModel $user
     * @return int|false El ID del nuevo registro o false en caso de error
     */
    public function create(SubjectModel $user) {
        try {
            $sql = "INSERT INTO user1 (nombre, correo, telefono) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            if ($stmt->execute([
                $user->getNombre(),
                $user->getCorreo(),
                $user->getTelefono(),
            ])) {
                return $this->conn->lastInsertId(); // Retorna el ID del nuevo registro
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage()); // Registra el error
            return false;
        }
    }

    /**
     * Lee todos los registros de la tabla user1.
     * 
     * @return array Lista de objetos SubjectModel
     */
    public function read() {
        try {
            $sql = "SELECT * FROM user1";
            $stmt = $this->conn->query($sql);
            $users = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $users[] = new SubjectModel($row['id'], $row['nombre'], $row['correo'], $row['telefono']);
            }
            return $users;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    /**
     * Busca un registro por ID en la tabla user1.
     * 
     * @param int $id
     * @return SubjectModel|null El objeto SubjectModel o null si no se encuentra
     */
    public function findById(int $id) {
        try {
            $stmt = $this->conn->prepare('SELECT * FROM user1 WHERE id = ?');
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new SubjectModel($row['id'], $row['nombre'], $row['correo'], $row['telefono']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    /**
     * Actualiza un registro en la tabla user1.
     * 
     * @param SubjectModel $user
     * @return bool true si la actualización fue exitosa, false en caso contrario
     */
    public function update(SubjectModel $user) {
        try {
            $fieldsToUpdate = [];
            $params = [];

            if ($user->getNombre() != null) {
                $fieldsToUpdate[] = "nombre = ?";
                $params[] = $user->getNombre();
            }
            if ($user->getCorreo() != null) {
                $fieldsToUpdate[] = "correo = ?";
                $params[] = $user->getCorreo();
            }
            if ($user->getTelefono() != null) {
                $fieldsToUpdate[] = "telefono = ?";
                $params[] = $user->getTelefono();
            }
            if (count($fieldsToUpdate) > 0) {
                $sql = "UPDATE user1 SET " . implode(', ', $fieldsToUpdate) . " WHERE id = ?";
                $params[] = $user->getId();

                $stmt = $this->conn->prepare($sql);
                return $stmt->execute($params);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Elimina un registro por ID en la tabla user1.
     * 
     * @param int $id
     * @return bool true si la eliminación fue exitosa, false en caso contrario
     */
    public function delete(int $id) {
        try {
            $sql = "DELETE FROM user1 WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
