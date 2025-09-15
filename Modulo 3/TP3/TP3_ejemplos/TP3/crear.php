<?php

if (isset($_POST['submit'])) {
  $resultado = [
    'error' => false,
    'mensaje' => 'El usuario ' . $_POST['usuario'] . ' ha sido agregado con éxito'
  ];

  // Incluimos los parámetros de configuración 
  $config = include 'config.php';

  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $usuario = array(
      "usuario"  => $_POST['usuario'],
      "clave"    => $_POST['clave'],
    );
var_dump($usuario);
    $consultaSQL = "INSERT INTO usuarios (usuario, clave) values (:" . implode(", :", array_keys($usuario)) . ")";

    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute($usuario);

  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}
?>

<?php include 'templates/header.php'; ?>

<?php
if (isset($resultado)) {
  ?>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-4">Crea un Usuario</h2>
      <hr>
      <form method="post">
<!--        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
        </div>
        <div class="form-group">
          <label for="apellido">Apellido</label>
          <input type="text" name="apellido" id="apellido" class="form-control">
        </div>
-->
        <div class="form-group">
          <label for="usuario">Usuario</label>
          <input type="text" name="usuario" id="usuario" class="form-control">
        </div>
        <div class="form-group">
          <label for="clave">clave</label>
          <input type="text" name="clave" id="clave" class="form-control">
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
          <a class="btn btn-primary" href="index.php">Regresar al Inicio</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'templates/footer.php'; ?>