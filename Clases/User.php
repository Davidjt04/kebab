<?php
class User{
    //Propiedades
    private $id;
    private $nombre;
    private $precio;
    private $contraseña;
    private $direccion;
    private $monedero;
    private $tlf;
    private $carrito;//cuando trabajo con Json en php será un string y cuando quiera uarlo lo decodificaré

    //constructor
    public function __construct($id,$nombre,$precio,$contraseña,$direccion,$monedero,$tlf,$carrito){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->contraseña = $contraseña;
        $this->direccion = $direccion;
        $this->monedero = $monedero;
        $this->tlf = $tlf;
        $this->carrito = $carrito;
    }

    //getter and setter
    //ID
    public function getId() {
        return $this->id;
    }
    // Nombre
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Precio
    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    // Contraseña
    public function getContraseña() {
        return $this->contraseña;
    }

    public function setContraseña($contraseña) {
        $this->contraseña = $contraseña;
    }

    // Dirección
    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    // Monedero
    public function getMonedero() {
        return $this->monedero;
    }

    public function setMonedero($monedero) {
        $this->monedero = $monedero;
    }

    // Teléfono
    public function getTlf() {
        return $this->tlf;
    }

    public function setTlf($tlf) {
        $this->tlf = $tlf;
    }

    // Carrito (almacenado en JSON)
    public function getCarrito() {
        return json_decode($this->carrito, true); // Decodifica el JSON a array asociativo
    }

    public function setCarrito($carrito) {
        $this->carrito = json_encode($carrito); // Codifica el array a JSON
    }

    // Método __toString para representar el objeto como una cadena
    public function __toString() {
        return "User: \n" .
                "ID: {$this->id}\n" .
                "Nombre: {$this->nombre}\n" .
                "Precio: {$this->precio}\n" .
                "Contraseña: {$this->contraseña}\n" .
                "Dirección: {$this->direccion}\n" .
                "Monedero: {$this->monedero}\n" .
                "Teléfono: {$this->tlf}\n" .
                "Carrito: " . json_encode($this->getCarrito()) . "\n"; // Usando getCarrito() para mostrar el carrito
    }
}

?>
