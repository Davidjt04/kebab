<?php
class Direccion {
    private $id;
    private $direccion;
    private $usuario_id;

    // Constructor
    public function __construct($id, $direccion, $usuario_id) {
        $this->id = $id;
        $this->direccion = $direccion;
        $this->usuario_id = $usuario_id;
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

    // Getter para $usuario_id
    public function getUsuario_id() {
        return $this->usuario_id;
    }

    // Método __toString 
    public function __toString() {
        return "ID: " . $this->id . 
        ", Dirección: " . $this->direccion;
    }
}
?>
