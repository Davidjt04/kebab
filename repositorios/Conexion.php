<?php
class Conexion{
    private static $con;

    public static function getConection(): PDO{
        if (self::$con == null){
            self::$con = new PDO("mysql:host=localhost;dbname=Kebab",'root','root');
        }
        return self::$con;
    }
}

?>