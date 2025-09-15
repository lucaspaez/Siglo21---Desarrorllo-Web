<?php
$error = false;
$config = include 'config.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  //echo $dsn;

  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

  if (isset($_POST['usuario'])) {
    $consultaSQL = "SELECT * FROM usuarios WHERE usuario LIKE '%" . $_POST['usuario'] . "%'";
  } else {
    $consultaSQL = "SELECT * FROM usuarios";
  }

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $usuarios = $sentencia->fetchAll();

} catch(PDOException $error) {
  $error= $error->getMessage();
}

$titulo = isset($_POST['usuario']) ? 'Lista de usuarios (' . $_POST['usuario'] . ')' : 'Lista de usuarios';
?>

<?php include "templates/header.php"; ?>

<?php
if ($error) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
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
      <a href="crear.php"  class="btn btn-primary mt-4">Crear Usuario</a>
      <hr>
      <form method="post" class="form-inline">
        <div class="form-group mr-10">
          <input type="text" id="usuario" name="usuario" placeholder="Buscar usuario" class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Buscar</button>
      </form>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-3"><?= $titulo ?></h2>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Usuario</th>
            <th>Clave</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($usuarios && $sentencia->rowCount() > 0) {
//            foreach ($usuarios as $fila) {
            for ($i = 0 ; $i < $sentencia->rowCount() ; ++$i) {
             $fila = $usuarios[$i] 
              ?>
              <tr>
                <td><?php echo $fila["id"]; ?></td>
                <td><?php echo $fila["usuario"]; ?></td>
                <td><?php echo $fila["clave"]; ?></td>
                <td>
                  <a href="<?= 'borrar.php?id=' . $fila["id"] ?>">🗑️Borrar</a>
                  <a href="<?= 'editar.php?id=' . $fila["id"] ?>" . >✏️Editar</a>
                </td>
              </tr>
              <?php
            }
          }
          ?>
        <tbody>
      </table>
    </div>
  </div>
</div>

<?php include "templates/footer.php"; ?>