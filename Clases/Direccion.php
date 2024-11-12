<?php
class Direccion {
    private $id;
    private $direccion;

    // Constructor
    public function __construct($id, $direccion) {
        $this->id = $id;
        $this->direccion = $direccion;
    }

    // Getter para $id
    public function getId() {
        return $this->id;
    }

    // Getter para $direccion
    public function getDireccion() {
        return $this->direccion;
    }

    // Setter para $direccion
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    // Método __toString 
    public function __toString() {
        return "ID: " . $this->id . 
        ", Dirección: " . $this->direccion;
    }
}
?>
