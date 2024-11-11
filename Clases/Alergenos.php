<?php
class Alergenos {
    private $id;
    private $foto;
    private $nombre;

    // Constructor
    public function __construct($id, $foto, $nombre) {
        $this->id = $id;
        $this->foto = $foto;
        $this->nombre = $nombre;
    }

    // Getter para id
    public function getId() {
        return $this->id;
    }

    // Getter para foto
    public function getFoto() {
        return $this->foto;
    }

    // Setter para foto
    public function setFoto($foto) {
        $this->foto = $foto;
    }

    // Getter para nombrea
    public function getNombre() {
        return $this->nombre;
    }

    // Setter para nombre
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Método __toString 
    public function __toString() {
        return "Alergenos: [ID: {$this->id}, Nombre: {$this->nombre}, Foto: {$this->foto}]";
    }
}

?>