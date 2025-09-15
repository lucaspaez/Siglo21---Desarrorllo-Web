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

//echo $_POST['especie'];

if (isset($_POST['submit'])) {
    $resultado = [
        'error' => false,
        'mensaje' => 'La planta de genética ' . $_POST['genetica'] . ' ha sido agregada con éxito'
    ];

    // Incluimos los parámetros de configuración 
    $config = include 'config.php';

    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        $plantas = array(
            "especie"  => $_POST['especie'],
            "genetica"    => $_POST['genetica'],
            "etapa"    => $_POST['etapa'],
            "cultivo"    => $_POST['cultivo'],
            "observaciones"    => $_POST['observaciones'],
            "ruta_imagen"    => $_POST['observaciones'],
        );
        var_dump($plantas);
        $consultaSQL = "INSERT INTO plantas (especie, genetica, etapa, cultivo, observaciones, ruta_imagen)
            values (:" . implode(", :", array_keys($plantas)) . ")";

        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute($plantas);
    } catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
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

                    <div class="bg-dark bg-gradient p-5 text-white" style="border-radius: 1rem;">

                        <h2 class="mb-2">Ingresar Datos</h2>
                        <p class="text-white-50 mb-3">Introduzca los datos de las plantas sin omitir nungún
                            campo por favor.</p>
                        <form method="post">
                            <div class="form-group form-white mb-4 text-start">
                                <label for="selecEspecie">Seleccione la Especie</label>
                                <select name="especie" id="selecEspecie" class="form-select" aria-label="Default select example">
                                    <option value="Sativa">Sativa</option>
                                    <option value="Indica">Indica</option>
                                </select>
                            </div>

                            <div data-mdb-input-init class="form-outline form-white mb-4 text-start">
                                <label for="selecGenetica">Seleccione Genética</label>
                                <select name="genetica" id="selecGenetica" class="form-select" aria-label="Default select example">
                                    <option value="Cannatonic">Cannatonic</option>
                                    <option value="CBD Therapy">CBD Therapy</option>
                                    <option value="Candida (CD-1)">Candida (CD-1)</option>
                                    <option value="Juanita La Lagrimosa">Juanita La Lagrimosa</option>
                                    <option value="OG Kush CBD">OG Kush CBD</option>
                                    <option value="CBD ComPassion">CBD ComPassion</option>
                                    <option value="Royal Medic">Royal Medic</option>
                                    <option value="CBD Critical Mass">CBD Critical Mass</option>
                                    <option value="S.A.G.E. CBD">S.A.G.E. CBD</option>
                                    <option value="CBD-Chronic">CBD-Chronic</option>
                                </select>
                            </div>

                            <div data-mdb-input-init class="form-outline form-white mb-4 text-start">
                                <label for="selecCicloVida">Seleccione etapa del ciclo de vida</label>
                                <select name="etapa" id="selecCicloVida" class="form-select" aria-label="Default select example">
                                    <option value="Germinación">Germinación</option>
                                    <option value="Plántula">Plántula</option>
                                    <option value="Vegetación">Vegetación</option>
                                    <option value="Floración">Floración</option>
                                </select>
                            </div>

                            <div data-mdb-input-init class="form-outline form-white mb-4 text-start">
                                <label for="selectTipoCultivo">Seleccione el tipo de cultivo</label>
                                <select name="cultivo" id="selectTipoCultivo" class="form-select" aria-label="Default select example">
                                    <option value="Sustrato">Sustrato</option>
                                    <option value="Hidropónico">Hidropónico</option>
                                </select>
                            </div>

                            <div data-mdb-input-init class="form-outline form-white mb-4 text-start">
                                <label for="datoObservaciones" class="form-label">Observaciones</label>
                                <textarea name="observaciones" class="form-control" id="datoObservaciones" rows="3"></textarea>
                            </div>

                            <div class="form-outline form-white mb-4 text-start">
                                <label for="selectImg" class="form-label">Seleccione una imágen</label>
                                <input name="imagen" type="file" class="form-control" id="selectImg">
                            </div>
                            <div class="form-group">
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5"
                                    type="submit" name="submit">Cargar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>