<!--
Materia: Desarrollo Web
Trabajo Práctico Nro 3
Fecha: 15/09/2025

Profesor Titular Disciplinar: Marisa Callejas
Titular Experto: Ricardo Ramón Daubroswsky
Alumno: Lucas Leonardo Paez
Legajo: VINF016138
-->

<?php
$error = false;
$config = include 'config.php';

try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    //echo $dsn;

    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $consultaSQL = "SELECT * FROM plantas";

    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute();

    $plantas = $sentencia->fetchAll();
} catch (PDOException $error) {
    $error = $error->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
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

<body class="gradient-custom">
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
                            <a class="nav-link" href="./cargarDatos.php">Cargar Datos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./stock.php">Ver Stock</a>
                        </li>
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

    <!--Tabla de Stock-->
    <section class="vh-100" style="margin-top: 56px;">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">

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

                    <H2 class="mb-3 text-white">Cantidad de plantas y su etapa:</H2>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Especie</th>
                                <th scope="col">Genética</th>
                                <th scope="col">Etapa</th>
                                <th scope="col">Cultivo</th>
                                <th scope="col">Observaciones</th>
                                <th scope="col">|||</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($plantas && $sentencia->rowCount() > 0) {
                                //            foreach ($usuarios as $fila) {
                                for ($i = 0; $i < $sentencia->rowCount(); ++$i) {
                                    $fila = $plantas[$i]
                            ?>
                            <tr>
                                <td><?php echo $fila["id"]; ?></td>
                                <td><?php echo $fila["especie"]; ?></td>
                                <td><?php echo $fila["genetica"]; ?></td>
                                <td><?php echo $fila["etapa"]; ?></td>
                                <td><?php echo $fila["cultivo"]; ?></td>
                                <td><?php echo $fila["observaciones"]; ?></td>
                                <td>
                                    <a class="text-decoration-none" href="<?= 'borrar.php?id=' . $fila["id"] ?>">🗑️</a>
                                    <a class="text-decoration-none" href="<?= 'editar.php?id=' . $fila["id"] ?>"
                                        .>✏️</a>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>