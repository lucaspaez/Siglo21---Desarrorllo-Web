<?php
$config = include 'config.php';

$resultado = [
  'error' => false,
  'mensaje' => ''
];

if (!isset($_GET['id'])) {
  $resultado['error'] = true;
  $resultado['mensaje'] = 'La planta no existe';
}

if (isset($_POST['submit'])) {
  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $planta = [
      "id"      => $_GET['id'],
      "especie" => $_POST['especie'],
      "genetica"   => $_POST['genetica'],
      "etapa"   => $_POST['etapa'],
      "cultivo"   => $_POST['cultivo'],
      "observaciones"   => $_POST['observaciones'],
      "ruta_imagen"   => $_POST['observaciones'],
    ];

    $consultaSQL = "UPDATE plantas SET
        especie = :especie,
        genetica = :genetica,
        etapa = :etapa,
        cultivo = :cultivo,
        observaciones = :observaciones,
        ruta_imagen = :ruta_imagen 
        WHERE id = :id";

    $consulta = $conexion->prepare($consultaSQL);
    $consulta->execute($planta);
  
  } catch (PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

  $id = $_GET['id'];
  $consultaSQL = "SELECT * FROM plantas WHERE id =" . $id;

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $planta = $sentencia->fetch(PDO::FETCH_ASSOC);

  if (!$planta) {
    $resultado['error'] = true;
    $resultado['mensaje'] = 'No se ha encontrado la planta';
  }
} catch (PDOException $error) {
  $resultado['error'] = true;
  $resultado['mensaje'] = $error->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cargar Datos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    .gradient-custom {
      /* fallback for old browsers */
      background: #6a11cb;

      /* Chrome 10-25, Safari 5.1-6 */
      background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

      /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
      background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
    }
  </style>
</head>

<body>
  <!--Barra de Navegación-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Sistema Planta Linda <i class="bi bi-flower3"></i></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
        aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Administrar</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <!--
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./login.php">Iniciar Sesión</a>
                        </li>-->
            <li class="nav-item">
              <a class="nav-link active" href="./cargarDatos.php">Cargar Datos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./stock.php">Ver Stock</a>
              <!--
                        <li class="nav-item">
                            <a class="nav-link" href="./variedades.php">Consultar Variedades</a>
                        </li>
                        -->
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!--Formulario de Carga de Datos-->
  <section class="hv-100 gradient-custom" style="margin-top: 56px;">
    <div class="container py-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-8">

          <?php
          if ($resultado['error']) {
          ?>
            <div class="container mt-2">
              <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-danger" role="alert">
                    <?= $resultado['mensaje'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
          ?>

          <?php
          if (isset($_POST['submit']) && !$resultado['error']) {
          ?>
            <div class="container mt-2">
              <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-success" role="alert">
                    El registro de la planta ha sido actualizada correctamente
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
          ?>

          <?php
          if (isset($planta) && $planta) {
          ?>

            <div class="bg-dark bg-gradient p-5 text-white" style="border-radius: 1rem;">

              <h2 class="mb-2">Editar Datos</h2>
              <p class="text-white-50 mb-3">Editando el registro de la planta <?= $planta['genetica']  ?></p>
              <form method="post">
                <div class="form-group form-white mb-4 text-start">
                  <label for="selecEspecie">Cambiar la Especie</label>

                  <?php
                  $valorPredeterminadoEspecie = $planta['especie'];

                  $opcionesEspecie = [
                    "Sativa" => "Sativa",
                    "Indica" => "Indica",
                  ];
                  ?>

                  <select name="especie" id="selecEspecie" class="form-select" aria-label="Default select example">
                    <?php
                    foreach ($opcionesEspecie as $valor => $texto) {
                      $seleccionado = ($valor === $valorPredeterminadoEspecie) ? 'selected' : '';
                    ?>
                      <option value="<?= $valor ?>" <?= $seleccionado ?>><?= $texto ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>

                <div data-mdb-input-init class="form-outline form-white mb-4 text-start">
                  <label for="selecGenetica">Cambiar Genética</label>

                  <?php
                  $valorPredeterminadoGenetica = $planta['genetica'];

                  $opcionesGenetica = [
                    "Cannatonic" => "Cannatonic",
                    "CBD Therapy" => "CBD Therapy",
                    "Candida (CD-1)" => "Candida (CD-1)",
                    "Juanita La Lagrimosa" => "Juanita La Lagrimosa",
                    "OG Kush CBD" => "OG Kush CBD",
                    "CBD ComPassion" => "CBD ComPassion",
                    "Royal Medic" => "Royal Medic",
                    "CBD Critical Mass" => "CBD Critical Mass",
                    "S.A.G.E. CBD" => "S.A.G.E. CBD",
                    "CBD-Chronic" => "CBD-Chronic",
                  ];
                  ?>

                  <select name="genetica" id="selecGenetica" class="form-select" aria-label="Default select example">

                    <?php
                    foreach ($opcionesGenetica as $valor => $texto) {
                      $seleccionado = ($valor === $valorPredeterminadoGenetica) ? 'selected' : '';
                    ?>
                      <option value="<?= $valor ?>" <?= $seleccionado ?>><?= $texto ?></option>
                    <?php
                    }
                    ?>

                  </select>
                </div>

                <div data-mdb-input-init class="form-outline form-white mb-4 text-start">
                  <label for="selecCicloVida">Cambiar etapa del ciclo de vida</label>

                  <?php
                  $valorPredeterminadoEtapa = $planta['etapa'];

                  $opcionesEtapa = [
                    "Germinación" => "Germinación",
                    "Plántula" => "Plántula",
                    "Vegetación" => "Vegetación",
                    "Floración" => "Floración",
                  ];
                  ?>

                  <select name="etapa" id="selecCicloVida" class="form-select" aria-label="Default select example">

                    <?php
                    foreach ($opcionesEtapa as $valor => $texto) {
                      $seleccionado = ($valor === $valorPredeterminadoEtapa) ? 'selected' : '';
                    ?>
                      <option value="<?= $valor ?>" <?= $seleccionado ?>><?= $texto ?></option>
                    <?php
                    }
                    ?>

                  </select>
                </div>

                <div data-mdb-input-init class="form-outline form-white mb-4 text-start">
                  <label for="selectTipoCultivo">Cambiar el tipo de cultivo</label>

                  <?php
                  $valorPredeterminadoCultivo = $planta['cultivo'];

                  $opcionesCultivo = [
                    "Sustrato" => "Sustrato",
                    "Hidropónico" => "Hidropónico",
                  ];
                  ?>

                  <select name="cultivo" id="selectTipoCultivo" class="form-select" aria-label="Default select example">

                    <?php
                    foreach ($opcionesCultivo as $valor => $texto) {
                      $seleccionado = ($valor === $valorPredeterminadoCultivo) ? 'selected' : '';
                    ?>
                      <option value="<?= $valor ?>" <?= $seleccionado ?>><?= $texto ?></option>
                    <?php
                    }
                    ?>

                  </select>
                </div>

                <div data-mdb-input-init class="form-outline form-white mb-4 text-start">
                  <label for="datoObservaciones" class="form-label">Observaciones</label>
                  <textarea name="observaciones" class="form-control" id="datoObservaciones" value="<?= $planta['observaciones'] ?>" rows="3"></textarea>
                </div>

                <div class="form-outline form-white mb-4 text-start">
                  <label for="selectImg" class="form-label">Cambiar imágen</label>
                  <input name="imagen" type="file" class="form-control" id="selectImg">
                </div>
                <div class="form-group">
                  <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5"
                    type="submit" name="submit">Guardar cambios</button>
                </div>
              </form>
            </div>



          <?php
          }
          ?>

        </div>
      </div>
    </div>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>