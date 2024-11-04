<?php
class User{
    //Propiedades
    private $id;
    private $nombre;
    private $foto;
    private $contraseña;
    private $direccion;
    private $monedero;
    private $tlf;
    private $carrito;
    private $ubicacion;
    //cuando trabajo con Json en php será un string y cuando quiera uarlo lo decodificaré

    //constructor
    public function __construct($id,$nombre,$foto,$contraseña,$direccion,$monedero,$tlf,$carrito,$ubicacion){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->foto = $foto;
        $this->contraseña = $contraseña;
        $this->direccion = $direccion;
        $this->monedero = $monedero;
        $this->tlf = $tlf;
        $this->carrito = $carrito;
        $this->ubicacion = $ubicacion;

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
    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
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

    // Teléfono
    public function getUbi() {
        return $this->tlf;
    }

    public function setUbi($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    // Método __toString para representar el objeto como una cadena
    public function __toString() {
        return "User: \n" .
                "ID: {$this->id}\n" .
                "Nombre: {$this->nombre}\n" .
                "Foto: {$this->foto}\n" .
                "Contraseña: {$this->contraseña}\n" .
                "Dirección: {$this->direccion}\n" .
                "Monedero: {$this->monedero}\n" .
                "Teléfono: {$this->tlf}\n" .
                "Carrito: " . json_encode($this->getCarrito()) . "\n" .// Usando getCarrito() para mostrar el carrito
                "Ubicacion: {$this->ubicacion}\n";

    }
}

?>
