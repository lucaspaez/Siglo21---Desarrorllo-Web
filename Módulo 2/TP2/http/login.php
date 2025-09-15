<!--
Materia: Desarrollo Web
Trabajo Práctico Nro 2
Fecha: 01/09/2025

Profesor Titular Disciplinar: Marisa Callejas
Titular Experto: Ricardo Ramón Daubroswsky
Alumno: Lucas Leonardo Paez
Legajo: VINF016138
-->

<?php

session_start();

// Variables de sesión:
$_SESSION['sesion_iniciada'] = true;
$_SESSION['nombre'] = $_POST['nombre'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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
    <!--Formuladio de ingreso del Nombre-->
    <section class="vh-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="bg-dark text-white" style="border-radius: 1rem;">
                        <div class="p-5 text-center">

                            <div class="mt-md-2">

                                <?php
                                    if(isset($_SESSION['nombre'])){
                                        echo "<h2>Has ingresado como " . $_SESSION['nombre'] . "</h2>";
                                        echo "<br><p><a href='cargarDatos.php' class='btn btn-outline-light btn-lg px-5'>Cargar datos..</a>";
                                    }else {
                                ?>
                                <form action="" method="POST">

                                    <h2 class="mb-2">Ingresar al Sistema</h2>
                                    <p class="text-white-50 mb-5">¡Por favor introduzca su Nombre!</p>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <input type="text" id="nombreUsuario" class="form-control form-control-lg" placeholder="Ingresá tu Nombre" name="nombre" required/>
                                    </div>
                                    
                                    <button data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-outline-light btn-lg px-5" type="submit">Ingresar</button>
                                </form>
                                <?php
                                    }
                                ?>  

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>