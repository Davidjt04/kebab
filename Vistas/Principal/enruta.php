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
    if ($_GET['menu'] == "mantenimiento") {
        require_once './vistas/mantenimiento/mantenimiento.php';
     
    }
    if ($_GET['menu'] == "listadoanimales") {
        require_once './vistas/mantenimiento/listadoanimales.php';
     
    }
    if ($_GET['menu'] == "listadovacunas") {
        require_once './vistas/mantenimiento/listadovacunas.php';
     
    }

    

    
}

    
    //Añadir otras rutas
