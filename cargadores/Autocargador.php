<?php
Class Autocargador
{

public static function autocargar()
{
    spl_autoload_register('self::autocarga');
}

  public static function autocarga($clase){
    //Rutas de carpetas donde estan las clases 
    echo "hola";
    $directories = [
      'api\\',
      'clases\\',
      'css\\',
      'helper\\',
      'recursos\\',
      'recursos\\icono\\',
      'recursos\\img\\',
      'recursos\\logo\\',
      'repositorios\\',
      'vistas\\estadoPedido\\',
      'vistas\\ingredientes\\',
      'vistas\\inicio\\',
      'vistas\\kebab\\',
      'vistas\\login\\',
      'vistas\\principal\\',
      'vistas\\registro\\',
      'controladores\\'
  ];
    // Recorremos los directorios para buscar la clase
  foreach($directories as $directory){
    $fichero = ROOT_PATH . $directory . $clase . '.php';
      // Si el archivo existe, lo incluimos
      echo ($fichero);

    if (file_exists($fichero)) {
      echo ($fichero);
      include $fichero;
      return;
  }

    // Si no se encuentra el archivo, se lanza una excepción
 }
throw new UnexpectedValueException("No se pudo cargar la clase: $clase");

}




}
Autocargador::autocargar();

