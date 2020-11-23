<?php
    require_once "_Varios.php";

    $conexion = obtenerPdoConexionBD();

    session_start(); // Crear post-it vacío, o recuperar el que ya haya  (vacío o con cosas).
    if (isset($_REQUEST["soloEstrellas"])) {
        $_SESSION["soloEstrellas"] = true;
    }
    if (isset($_REQUEST["todos"])) {
        unset($_SESSION["soloEstrellas"]);
    }

    $posibleClausulaWhere = isset($_SESSION["soloEstrellas"]) ? "WHERE m.estrella=1" : "";

    $sql = "
               SELECT
                    m.id     AS mId,
                    m.modelo AS mModelo,
                    m.motor AS mMotor,
                    m.caballos AS mCaballos,
                    m.combustible AS mCombustible,
                    m.estrella AS mEstrella,
                    c.id     AS cId,
                    c.nombre AS cNombre
                FROM
                   modelo AS m INNER JOIN marca AS c
                   ON m.marcaId = c.id
                $posibleClausulaWhere
                ORDER BY m.modelo
            ";

    $select = $conexion->prepare($sql);
    $select->execute([]); // Array vacío porque la consulta preparada no requiere parámetros.
    $rs = $select->fetchAll();


    // INTERFAZ:
    // $rs
    // $_SESSION
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<h1>Listado de coches</h1>

<table border='1'>

    <tr>
        <th>Modelo</th>
        <th>Marca</th>
    </tr>

    <?php
    foreach ($rs as $fila) { ?>
        <tr>
            <td>
                <?php
                    $urlImagen = $fila["mEstrella"] ? "img/EstrellaRellena.png" : "img/EstrellaVacia.png";
                    echo " <a href='ModeloEstablecerEstadoEstrella.php?id=$fila[mId]'><img src='$urlImagen' width='16' height='16'></a> ";

                    echo "<a href='ModeloFicha.php?id=$fila[mId]'>";
                    echo "$fila[mModelo]";
                    if ($fila["mMotor"] != "") {
                        echo " $fila[mMotor]";
                    }
                    echo "</a>";
                ?>
            </td>
            <td><a href= 'MarcaFicha.php?id=<?=$fila["cId"]?>'> <?= $fila["cNombre"] ?> </a></td>
            <td><a href='ModeloEliminar.php?id=<?=$fila["mId"]?>'> (X)                      </a></td>
        </tr>
    <?php } ?>

</table>

<br />

<?php if (!isset($_SESSION["soloEstrellas"])) {?>
    <a href='ModeloListado.php?soloEstrellas'>Ver coches favoritos</a>
<?php } else { ?>
    <a href='ModeloListado.php?todos'>Mostrar todos los coches</a>
<?php } ?>

<br />
<br />

<a href='ModeloFicha.php?id=-1'>Añadir coche</a>

<br />
<br />

<a href='MarcaListado.php'>Ir a lista de Marcas</a>

</body>

</html>