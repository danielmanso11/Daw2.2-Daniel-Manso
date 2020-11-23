<?php
	require_once "_Varios.php";

	$conexionBD = obtenerPdoConexionBD();

	// Los campos que incluyo en el SELECT son los que luego podré leer
    // con $fila["campo"].
	$sql = "SELECT id, nombre FROM marca ORDER BY nombre";

    $select = $conexionBD->prepare($sql);
    $select->execute([]); // Array vacío porque la consulta preparada no requiere parámetros.
    $rs = $select->fetchAll();

    // INTERFAZ:
    // $rs
?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<h1>Lista de Marcas</h1>

<table border='1'>

	<tr>
		<th>        Marca       </th>
	</tr>

	<?php foreach ($rs as $fila) { ?>
        <tr>
            <td><a href='MarcaFicha.php?id=<?=$fila["id"]?>'> <?=$fila["nombre"] ?> </a></td>
            <td><a href='MarcaEliminar.php?id=<?=$fila["id"]?>'> (X)                   </a></td>
        </tr>
	<?php } ?>

</table>

<br />

<a href='MarcaFicha.php?id=-1'>Nueva marca</a>

<br />
<br />

<a href='ModeloListado.php'>Gestionar modelos</a>

</body>

</html>