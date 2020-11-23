<?php
	require_once "_Varios.php";

	$conexion = obtenerPdoConexionBD();
	
	// Se recoge el parámetro "id" de la request.
	$id = (int)$_REQUEST["id"];

	// Si id es -1 quieren CREAR una nueva entrada ($nueva_entrada tomará true).
	// Sin embargo, si id NO es -1 quieren VER la ficha de una marca existente
	// (y $nueva_entrada tomará false).
	$nuevaEntrada = ($id == -1);

	if ($nuevaEntrada) { // Quieren CREAR una nueva entrada, así que no se cargan datos.
		$marcaNombre = "";
	} else { // Quieren VER la ficha de una marca existente, cuyos datos se cargan.
		$sql = "SELECT nombre FROM marca WHERE id=? ORDER BY nombre";

        $select = $conexion->prepare($sql);
        $select->execute([$id]); // Se añade el parámetro a la consulta preparada.
        $rs = $select->fetchAll();
		
		 // Con esto, accedemos a los datos de la primera (y esperemos que única) fila que haya venido.
		$marcaNombre = $rs[0]["nombre"];
	}



    $sql = "SELECT * FROM modelo WHERE marcaId=?"; // o nombreModelo

    $select = $conexion->prepare($sql);
    $select->execute([$id]); // Array vacío porque la consulta preparada no requiere parámetros.
    $rsModeloDeLaMarca = $select->fetchAll();


	// INTERFAZ:
    // $nuevaEntrada
    // $marcaNombre
    // $rsModelosDeLaMarca
?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<?php if ($nuevaEntrada) { ?>
	<h1>Nueva marca</h1>
<?php } else { ?>
	<h1>Marca seleccionada</h1>
<?php } ?>

<form method='post' action='MarcaGuardar.php'>

<input type='hidden' name='id' value='<?=$id?>' />

    <label for='nombre'>Nombre: </label>
	<input type='text' name='nombre' placeholder = "introduzca un nombre" value='<?=$marcaNombre?>' />
    <br/>

    <br/>

<?php if ($nuevaEntrada) { ?>
	<input type='submit' name='crear' value='Crear marca' />
<?php } else { ?>
	<input type='submit' name='guardar' value='Guardar cambios' />
<?php } ?>

</form>

<br />

<p>Modelos de la marca:</p>

<ul>
<?php
    foreach ($rsModeloDeLaMarca as $fila) {
        echo "<li>$fila[modelo] $fila[motor]</li>";
    }
?>
</ul>

<?php if (!$nuevaEntrada) { ?>
    <br />
    <a href='MarcaEliminar.php?id=<?=$id?>'>Eliminar marca</a>
<?php } ?>

<br />
<br />

<a href='MarcaListado.php'>Volver a lista de marcas.</a>

</body>

</html>