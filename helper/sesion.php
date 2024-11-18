<?php
class Sesion
{
    public static function iniciar()
    {
        echo "iniciar";

    }

    public static function leer(string $clave)
    {
        echo "leer";
    }

    public static function existe(string $clave)
    {
        echo "existe";
    }

    public static function escribir($clave,$valor)
    {
        
    }

    public static function eliminar($clave)
    {
        
    }
}