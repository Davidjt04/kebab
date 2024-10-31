<?php
class Alergenos {
    private $id;
    private $descripcion;
    private $foto;
    private $nombre;

    // Constructor
    public function __construct($id, $descripcion, $foto, $nombre) {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->foto = $foto;
        $this->nombre = $nombre;
    }

    // Getter para id
    public function getId() {
        return $this->id;
    }
    // Getter para descripcion
    public function getDescripcion() {
        return $this->descripcion;
    }

    // Setter para descripcion
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    // Getter para foto
    public function getFoto() {
        return $this->foto;
    }

    // Setter para foto
    public function setFoto($foto) {
        $this->foto = $foto;
    }

    // Getter para nombre
    public function getNombre() {
        return $this->nombre;
    }

    // Setter para nombre
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Método __toString 
    public function __toString() {
        return "Alergenos: [ID: {$this->id}, Nombre: {$this->nombre}, Descripcion: {$this->descripcion}, Foto: {$this->foto}]";
    }
}

?>