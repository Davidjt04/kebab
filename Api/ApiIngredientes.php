<?php
/*codigo que manda la response */
//cogemos el REQUEST_METHOD pertinente
include '../controladores/ControlIngrediente.php';
$request = $_SERVER['REQUEST_METHOD'];
//Creo un objeto controlador que usare en el switch 
$control = new controlIngrediente();
switch ($request) {
    case 'GET':
        $cadena = $_GET['id'];
        // var_dump($cadena);
        // var_dump($cadena);
        //Creo un objeto controlador
        $tupla = $control->cogerDatos($cadena);
        // var_dump($tupla);
        // echo json_encode($tupla);
        $jsonTupla = json_encode($tupla);
        echo $jsonTupla;
        break;
    case 'POST':  
        //me va a modificar y a crear el objeto 
        $datos = json_decode(file_get_contents('php://input'),true);
        //llamo al controlador para ya guardar en la base de datos 
        json_encode($datos);
       $control->meterDatos($datos);
       
        break;
    case 'DELETE':
        //Va a borrar los datos 
        $datos = json_decode(file_get_contents('php://input'),true);
        $id= $datos['id'];
        // json_encode($datos);
        $control->borrarDatos($id);
        break;

    default:
        throw new Exception("Error al procesar la Request");
        
}

?>