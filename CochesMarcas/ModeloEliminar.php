<?php
	require_once "_Varios.php";

	$conexion = obtenerPdoConexionBD();

	// Se recoge el parámetro "id" de la request.
	$id = (int)$_REQUEST["id"];

	$sql = "DELETE FROM modelo WHERE id=?";

    $sentencia = $conexion->prepare($sql);
    //Esta llamada devuelve true o false según si la ejecución de la sentencia ha ido bien o mal.
    $sqlConExito = $sentencia->execute([$id]); // Se añade el parámetro a la consulta preparada.

    //Se consulta la cantidad de filas afectadas por la ultima sentencia sql.
    $unaFilaAfectada = ($sentencia->rowCount() == 1);
    $ningunaFilaAfectada = ($sentencia->rowCount() == 0);

    // Está todo correcto de forma normal si NO ha habido errores y se ha visto afectada UNA fila.
    $correcto = ($sqlConExito && $unaFilaAfectada);

 	// Caso raro: no había un caso con ese id...
 	$noExistia = ($sqlConExito && $ningunaFilaAfectada);
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php if ($correcto) { ?>

	<h1>Eliminación completada</h1>
	<p>Se ha eliminado correctamente el modelo.</p>

<?php } else if ($noExistia) { ?>

	<h1>Eliminación imposible</h1>
	<p>No existe el modelo que se pretende eliminar (¿ha manipulado Vd. el parámetro id?).</p>

<?php } else { ?>

	<h1>Error en la eliminación</h1>
	<p>No se ha podido eliminar el modelo o el modelo no existía.</p>

<?php } ?>

<a href='ModeloListado.php'>Volver a la lista de modelos.</a>

</body>

</html>