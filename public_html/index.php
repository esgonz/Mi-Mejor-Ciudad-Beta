<?php
//crea una sesión para ser usada mediante una petición GET o POST, o pasado por una cookie
// y la sentencia include_once es la usaremos para incluir el archivo de conexión a la 
// base de datos que creamos anteriormente.
 if (!isset($_SESSION) ){
    session_start();
 }

 require_once('conexion.php');

  if (isset($_GET['controlador']) && isset($_GET['accion'])) {
    $controller = $_GET['controlador'];
    $action     = $_GET['accion'];
  } else {

    $controller = 'pages';
    $action     = 'home';
  }

  require_once('vistas/layout.php');
?>