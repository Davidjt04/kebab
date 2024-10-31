<?php
class Ingredientes{
    private $id;
    private $estado;
    private $fecha;
    private $precio;

    // Constructor
    public function __construct($id, $estado, $fecha, $precio) {
        $this->id = $id;
        $this->estado = $estado;
        $this->fecha = $fecha;
        $this->precio = $precio;
    }

    //Getter y setter
    // Getter para id
    public function getId() {
        return $this->id;
    }

    // Getter para estado
    public function getEstado() {
        return $this->estado;
    }

    // Setter para estado
    public function setEstado($estado) {
        $this->estado = $estado;
    }

    // Getter para fecha
    public function getFecha() {
        return $this->fecha;
    }

    // Setter para fecha
    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    // Getter para precio
    public function getPrecio() {
        return $this->precio;
    }

    // Setter para precio
    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    // Método __toString 
    public function __toString() {
        return "Alergenos: \n" .
            "ID: {$this->id}\n" .
            "Nombre: {$this->nombre}\n" .
            "Descripción: {$this->descripcion}\n" .
            "Foto: {$this->foto}\n";
    }
}


?>