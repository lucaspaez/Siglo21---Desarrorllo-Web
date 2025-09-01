<?php
session_start();
$sesion = $_SESSION['usuario'];
if (!isset($sesion)) {
    header("location: login.php");

}
else {

    echo "<h1> BIENVENIDO $sesion </h1><br>";

    echo "<a href='logica/salir.php'>Salir</a>";
}

?>