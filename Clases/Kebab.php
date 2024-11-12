<?php
class Kebab{
    public $id;
    public $nombre;
    public $foto;
    public $precio;
    public $descripcion;
    public array $ingredientes = []; //Array de ingredientes del kebab

    // Constructor
    public function __construct($id, $nombre, $foto, $precio, $descripcion) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->foto = $foto;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
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

    // Getter para Descripcion
    public function getDescripcion() {
        return $this->descripcion;
    }
    
    // Setter para Descripcion
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    // Método para llenar el array de ingredientes
    public function llenarIngredientes() {
        $repo = new RepoKebab();
        $this->ingredientes = $repo->obtenerIngredientesPorKebab($this->id);
    }

    // Método __toString 
    public function __toString() {
    return "Alergenos: \n" .
        "ID: {$this->id}\n" .
        "Nombre: {$this->nombre}\n" .
        "Foto: {$this->foto}\n" .
        "Precio: {$this->precio}\n" .
        "Descripcion: {$this->descripcion}\n" ;
}
}
?>