<?php
class UserRepository {
    private $users = []; // Simulando la "base de datos" con un array

    // Método para agregar un usuario (para facilitar pruebas)
    public function add(User $user) {
        $this->users[$user->getId()] = $user; // Usamos el ID como clave
    }

    // Método para encontrar un usuario por ID
    public function findById($id) {
        if (isset($this->users[$id])) {
            return $this->users[$id]; // Devuelvo el usuario encontrado
        }
        return null; // Devuelvo null si no se encuentra
    }

    // Método para obtener todos los usuarios
    public function findAll() {
        return array_values($this->users); // Devuelvo un array con todos los usuarios
    }

    // Método para eliminar un usuario por ID
    public function delete($id) {
        if (isset($this->users[$id])) {
            unset($this->users[$id]); // Elimina el usuario
            return true; // Devuelvo true si se eliminó con éxito
        }
        return false; // Devuelvo false si no se encuentra el usuario
    }
}
?>