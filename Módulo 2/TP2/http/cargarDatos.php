<!--
Materia: Desarrollo Web
Trabajo Práctico Nro 2
Fecha: 01/09/2025

Profesor Titular Disciplinar: Marisa Callejas
Titular Experto: Ricardo Ramón Daubroswsky
Alumno: Lucas Leonardo Paez
Legajo: VINF016138
-->

<?php session_start(); ?>

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
    <!--Formulario de Carga de Datos-->
    <section class="h-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8">

                    <div class="bg-dark bg-gradient p-5 text-white" style="border-radius: 1rem;">

                        <?php
                            if(isset($_SESSION['nombre'])){
                                echo "<h2 class='mb-2'>Hola " . $_SESSION['nombre'] . "</h2>";
                        ?>
                        <p class="text-white-50 mb-3">Ingresa los datos de las plantas sin omitir nungún campo por favor.</p>
                        
                            <div data-mdb-input-init class="form-outline form-white mb-4 text-start">
                                <label for="selecEspecie">Seleccione la Especie</label>
                                <select id="selecEspecie" class="form-select" aria-label="Default select example">
                                    <option value="1">Sativa</option>
                                    <option value="2">Indica</option>
                                </select>
                            </div>

                            <div data-mdb-input-init class="form-outline form-white mb-4 text-start">
                                <label for="selecGenetica">Seleccione Genética</label>
                                <select id="selectGenetica" class="form-select" aria-label="Default select example">
                                    <option value="1">Cannatonic</option>
                                    <option value="2">CBD Therapy</option>
                                    <option value="3">Candida (CD-1)</option>
                                    <option value="4">Juanita La Lagrimosa</option>
                                    <option value="5">OG Kush CBD</option>
                                    <option value="6">CBD ComPassion</option>
                                    <option value="7">Royal Medic</option>
                                    <option value="8">CBD Critical Mass</option>
                                    <option value="9">S.A.G.E. CBD</option>
                                    <option value="10">CBD-Chronic</option>
                                </select>
                            </div>

                            <div data-mdb-input-init class="form-outline form-white mb-4 text-start">
                                <label for="selecCicloVida">Seleccione etapa del ciclo de vida</label>
                                <select id="selecCicloVida" class="form-select" aria-label="Default select example">
                                    <option value="1">Germinación</option>
                                    <option value="2">Plántula</option>
                                    <option value="3">Vegetación</option>
                                    <option value="4">Floración</option>
                                </select>
                            </div>

                            <div data-mdb-input-init class="form-outline form-white mb-4 text-start">
                                <label for="selectTipoCultivo">Seleccione el tipo de cultivo</label>
                                <select id="selectTipoCultivo" class="form-select" aria-label="Default select example">
                                    <option value="1">Sustrato</option>
                                    <option value="2">Hidropónico</option>
                                </select>
                            </div>

                            <div data-mdb-input-init class="form-outline form-white mb-4 text-start">
                                <label for="datoObservaciones" class="form-label">Observaciones</label>
                                <textarea class="form-control" id="datoObservaciones" rows="3"></textarea>
                            </div>

                            <div class="form-outline form-white mb-4 text-start">
                                <label for="selectImg" class="form-label">Seleccione una imágen</label>
                                <input type="file" class="form-control" id="selectImg">
                            </div>

                            <button data-bs-toggle="modal" data-bs-target="#mi-modal" class="btn btn-outline-light btn-lg px-5">Ver Datos a Cargar</button>
                            
                            <?php
                            }
                            ?>

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