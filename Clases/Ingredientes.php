<?php
class Ingredientes{
    private $id;
    private $nombre;
    private $foto;
    private $precio;
    private $tipo;
    private array $alergenos = [];      //array de alergenos por ingrediente

    // Constructor
    public function __construct($id, $nombre, $foto, $precio,$tipo) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->foto = $foto;
        $this->precio = $precio;
        $this->tipo = $tipo;
        //rellenamos el array de alergenos del ingrediente
        // $this->alergenos = RepoIngredientes::obtenerAlergenosPorIngrediente($this->id);

    }

    //Getter y setter
    // Getter para id
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

    // Foto
    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    // Precio
    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    // Tipo
    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    //Getter alergeno
    public function getAlergenos() {
        return $this->alergenos;
    }
    // Método __toString para representar el objeto como un string
    public function __toString() {
        return "Ingrediente [ID: "
         . $this->getId() . 
         ", Nombre: " . $this->getNombre() . 
         ", Foto: " . $this->getFoto() . 
         ", Precio: " . $this->getPrecio() . 
         ", Tipo: " . $this->getTipo() . 
         ", Alergenos: " . implode(", ", $this->getAlergenos()) . "]";
    }
}


?>