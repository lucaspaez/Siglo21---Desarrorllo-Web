<?php
session_start();
require 'conexion.php';
$user = $_POST['usuario'];
$clave = $_POST['clave'];


$query = "SELECT COUNT(*) as contar FROM usuarios where usuario = '$user' and clave = '$clave' ";
$bdconect = mysqli_query($conectar,$query);
$parametros = mysqli_fetch_array($bdconect);
if($parametros['contar']>0){
   $_SESSION['usuario'] = $user;
  header("location: ../paginaprincipal.php");
}else {
    echo "<h1>datos incorrectos</h1> <br> ";
    echo "<a href='../login.php'>Volver</a>";
}


?>