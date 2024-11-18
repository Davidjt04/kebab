<?php
class Principal
{

    public static function main()
    {
        require_once './cargadores/Autocargador.php';
        require_once './vistas/principal/layout.php';
        
    }
}
define('ROOT_PATH', __DIR__ . '\\');         //definir el root path en esta ubicacion 
Principal::main();
?>
