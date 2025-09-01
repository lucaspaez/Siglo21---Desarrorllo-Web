<?php

session_start();  // Continuar la sesión

if (isset($_SESSION['sesion_iniciada']) == true) {

	echo "FINALIZAR LA SESIÓN<br />";
	echo "==================<p />";

	echo "<p />";
	echo "Identificador de la sesión: [" . session_id() . "]<br/>";
	echo "Nombre de la sesión: [" . session_name() . "]<p/>";

	session_unset();													// Borrar las variables de sesión
	setcookie(session_name(), 0, 1, ini_get("session.cookie_path"));	// Eliminar la cookie
	session_destroy();													// Destruye el resto de información sobre la sesión

	// Comprobar la variable de sesión 'nombre':
	if (isset($_SESSION['nombre']))
		echo "Ahora el nombre es: " . $_SESSION['nombre'] . "<br />";
	else
		echo "La variable de sesión 'nombre' no está definida.<br />";

	// Comprobar la variable de sesión 'edad':
	if (isset($_SESSION['edad']))
		echo "Ahora la edad es: " . $_SESSION['edad'] . "<br />";
	else
		echo "La variable de sesión 'edad' no está definida.<br />";

	// Comprobar el array de sesión 'aDatos':
	if (isset($_SESSION['aDatos'])) {
		echo "Ahora el nombre (en array) es: " . $_SESSION['aDatos']['nombre'] . "<br/>";
		echo "Ahora la edad (en array) es: " . $_SESSION['aDatos']['edad'] . "<br/>";
	} else
		echo "La array de sesión 'aDatos' no está definido.";


	echo "<p>SESIÓN FINALIZADA CORRECTAMENTE</p>";
} else {
	echo "<p>No has pasado por la página principal</p>";
}

echo "<a href='sesion2.php'>Comprobar los valores en otra página (no se mostrará nada por haber finalizado la sesión)</a><br/>";
echo "<a href='sesion1.php'>Volver a la página principal</a>";
