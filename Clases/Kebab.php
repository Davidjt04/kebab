<?php
class Kebab{
    private $id;
    private $nombre;
    private $foto;
    private $precio;

    // Constructor
    public function __construct($id, $nombre, $foto, $precio) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->foto = $foto;
        $this->precio = $precio;
    }

    //Getter y setter
    // Getter para id
    public function getId() {
        return $this->id;
    }

    // Getter para nombre
    public function getNombre() {
        return $this->nombre;
    }

    // Setter para nombre
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Getter para foto
    public function getFoto() {
        return $this->foto;
    }

    // Setter para foto
    public function setFoto($foto) {
        $this->foto = $foto;
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
        "Foto: {$this->foto}\n" .
        "Precio: {$this->precio}\n";
}
}
?>