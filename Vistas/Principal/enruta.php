<?php
if (isset($_GET['menu'])) {
    if ($_GET['menu'] == "inicio") {
        require_once 'index.php';
    }
    if ($_GET['menu'] == "login") {
        require_once './vistas/login/autentifica.php';
    }
    if ($_GET['menu'] == "cerrarsesion") {
        require_once './vistas/login/cerrarsesion.php';
     
    }
    if ($_GET['menu'] == "Inicio") {
        require_once './vistas/inicio/Inicio.php';
     
    }

    if($_GET['menu'] == "ingredientes"){
        require_once './vistas/ingredientes/Ingredientes.php';
    }

    if($_GET['menu'] == "kebab"){
        require_once './vistas/kebab/Kebab.php';
    }

    if($_GET['menu'] == "registro"){
        require_once './vistas/registro/Registro.php';
    }

    if($_GET['menu'] == "estadoPedido"){
        require_once './vistas/estadoPedido/EstadoPedido.php';
    }
    
    if ($_GET['menu'] == "listadoanimales") {
        require_once './vistas/mantenimiento/listadoanimales.php';
     
    }
    if ($_GET['menu'] == "listadovacunas") {
        require_once './vistas/mantenimiento/listadovacunas.php';
     
    }

    

    
}

    
    //Añadir otras rutas
