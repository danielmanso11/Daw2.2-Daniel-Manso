<?php
	require_once "_Varios.php";

	$conexion = obtenerPdoConexionBD();
	
	// Se recoge el parámetro "id" de la request.
	$id = (int)$_REQUEST["id"];

	// Si id es -1 quieren CREAR una nueva entrada ($nueva_entrada tomará true).
	// Sin embargo, si id NO es -1 quieren VER la ficha de una modelo existente
	// (y $nueva_entrada tomará false).
	$nuevaEntrada = ($id == -1);
	
	if ($nuevaEntrada) { // CREAR una nueva entrada,pero no se cargan datos.
		$modeloNombre = "";
        $modeloMotor = "";
		$modeloCaballos = "";
        $modeloCombustible = "";
        $modeloEstrella = false;
		$modeloMarcaIdId = 0;
	} else { // Quieren VER la ficha de una modelo existente, cuyos datos se cargan.
        $sqlModelo = "SELECT * FROM modelo WHERE id=?";

        $select = $conexion->prepare($sqlModelo);
        $select->execute([$id]); // Se añade el parámetro a la consulta preparada.
        $rsModelo = $select->fetchAll();

        // Con esto, accedemos a los datos de la primera (y esperemos que única) fila que haya venido.
        $modeloNombre = $rsModelo[0]["modelo"];
        $modeloMotor = $rsModelo[0]["motor"];
        $modeloCaballos = $rsModelo[0]["caballos"];
        $modeloCombustible = $rsModelo[0]["combustible"];
        $modeloEstrella = ($rsModelo[0]["estrella"] == 1); // En BD está como TINYINT. 0=false, 1=true. Con esto convertimos a booolean.
        $modeloMarcaId = $rsModelo[0]["marcaId"];
	}

	
	
	// Con lo siguiente se deja preparado un recordset con todas las Marcas.
	
	$sqlMarcas = "SELECT id, nombre FROM marca ORDER BY nombre";

    $select = $conexion->prepare($sqlMarcas);
    $select->execute([]); // Array vacío porque la consulta preparada no requiere parámetros.
    $rsMarcas = $select->fetchAll();


    //  Interfaz
    //  $modeloNombre
    //  $modeloMotor
    //  $modeloCaballos
    //  $modeloCombustible
    //  $modeloEstrella
    //  $modeloMarcaId
?>




<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<?php if ($nuevaEntrada) { ?>
	<h1>Nuevo modelo</h1>
<?php } else { ?>
	<h1>Modelo</h1>
<?php } ?>

<form method='get' action='ModeloGuardar.php'>

<input type='hidden' name='id' value='<?= $id ?>' />

    <label for='modelo'> Modelo</label>
    <input type='text' name='modelo' placeholder = "introduzca nombre" value='<?=$modeloNombre ?>' />
    <br/>

    <label for='motor'> Motor</label>
    <input type='text' name='motor' placeholder = "introduzca el motor" value='<?=$modeloMotor ?>' />
    <br/>

    <label for='caballos'> Caballos</label>
    <input type='text' name='caballos' placeholder = "introduzca los caballos" value='<?=$modeloCaballos ?>' />
    <br/>

    <label for='combustible'> Combustible</label>
    <input type='text' name='combustible' placeholder = "introduzca el combustible" value='<?=$modeloCombustible ?>' />
    <br/>

    <label for='marcaId'>Marca</label>
    <select name='marcaId'>
        <?php
            foreach ($rsMarcas as $filaMarca) {
                $marcaId = (int) $filaMarca["id"];
                $marcaNombre = $filaMarca["nombre"];

                if ($marcaId == $modeloMarcaId) $seleccion = "selected='true'";
                else                                     $seleccion = "";

                echo "<option value='$marcaId' $seleccion>$marcaNombre</option>";

                           }
        ?>
    </select>
    <br/>

    <label for='estrella'>Favorito</label>
    <input type='checkbox' name='estrella' <?= $modeloEstrella ? "checked" : "" ?> />
    <br/>

    <br/>

<?php if ($nuevaEntrada) { ?>
	<input type='submit' name='crear' value='Crear modelo' />
<?php } else { ?>
	<input type='submit' name='guardar' value='Guardar cambios' />
<?php } ?>

</form>

<?php if (!$nuevaEntrada) { ?>
    <br />
    <a href='ModeloEliminar.php?id=<?=$id ?>'>Eliminar modelo</a>
<?php } ?>

<br />
<br />

<a href='ModeloListado.php'>Volver a la lista de modelos</a>

</body>

</html>