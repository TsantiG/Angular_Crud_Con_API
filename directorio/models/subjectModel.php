<?php

/**
 * Clase que representa un registro de la tabla user1
 */
class SubjectModel {

 
    private  $id;

    /**
     * @var string
     */
    private string $nombre;

    /**
     * @var string
     */
    private string $correo;

    /**
     * @var string
     */
    private string $telefono;

    /**
     * Constructor de la clase
     * 
  
     * @param string $nombre
     * @param string $correo
     * @param string $telefono
     */
    public function __construct($id=null, string $nombre, string $correo, string $telefono) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->telefono = $telefono;
    }

    public function toArray() {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'correo' => $this->getCorreo(),
            'telefono' => $this->getTelefono()
        ];

    }
    // Getters
    public function getId(): int { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getCorreo(): string { return $this->correo; }
    public function getTelefono(): string { return $this->telefono; }

    // Setters con validación
    public function setId(int $id) { $this->id = $id; }
    public function setNombre(string $nombre) { 
        if (strlen($nombre) <= 50) {
            $this->nombre = $nombre;
        } else {
            throw new InvalidArgumentException("Nombre no puede exceder los 50 caracteres");
        }
    }
    public function setCorreo(string $correo) { 
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $this->correo = $correo;
        } else {
            throw new InvalidArgumentException("Correo no es válido");
        }
    }
    public function setTelefono(string $telefono) { 
        if (preg_match('/^[0-9]{10,20}$/', $telefono)) {
            $this->telefono = $telefono;
        } else {
            throw new InvalidArgumentException("Teléfono debe tener entre 10 y 20 dígitos");
        }
    }
}

