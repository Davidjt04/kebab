<?php
class LineaPedido{
    private $id;
    private $cantidad;
    private $precio;
    private $lineaPedido;

    // Constructor
    public function __construct($id, $cantidad, $precio, $lineaPedido) {
        $this->id = $id;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->lineaPedido = $lineaPedido;
    }

    //Getter y setter
    public function getId() {
        return $this->id;
    }

    // Getter para cantidad
    public function getCantidad() {
        return $this->cantidad;
    }

    // Setter para cantidad
    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    // Getter para precio
    public function getPrecio() {
        return $this->precio;
    }

    // Setter para precio
    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    // Getter para lineaPedido
    public function getLineaPedido() {
        return $this->lineaPedido;
    }

    // Setter para lineaPedido
    public function setLineaPedido($lineaPedido) {
        $this->lineaPedido = $lineaPedido;
    }

    // Método __toString para representar el objeto como una cadena
    public function __toString() {
    return "LineaPedido: \n" .
        "ID: {$this->id}\n" .
        "Cantidad: {$this->cantidad}\n" .
        "Precio: {$this->precio}\n" .
        "Linea de Pedido: {$this->lineaPedido}\n";
}
}
?>