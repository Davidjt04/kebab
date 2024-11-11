<?php
class Ingredientes{
    private $id;
    private $nombre;
    private $foto;
    private $precio;
    private $tipo;
    private array $alergenos = [];

    // Constructor
    public function __construct($id, $nombre, $foto, $precio,$tipo,array $alergenos=[]) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->foto = $foto;
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->alergenos = $alergenos;
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
    public function addAlergeno(Alergenos $alergeno) {
        $this->alergenos[] = $alergeno;
    }
}


?>