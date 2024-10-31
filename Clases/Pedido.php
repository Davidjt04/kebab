<?php
class Pedido{
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

    //Getter and setter
    // ID
    public function getId() {
        return $this->id;
    }

    // Estado
    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    // Fecha
    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    // Precio
    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }
    //__toString
    public function __toString() {
    return "Pedido: \n" .
        "ID: {$this->id}\n" .
        "Estado: {$this->estado}\n" .
        "Fecha: {$this->fecha}\n" .
        "Precio: {$this->precio}\n";
}
}
?>