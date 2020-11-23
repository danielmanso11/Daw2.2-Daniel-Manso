<?php
    require_once "_Varios.php";

    $conexionBD = obtenerPdoConexionBD(); //Lo he intentado largo tiempo y no consigo solventar el fallo del link,
                                          //no se me ocure lo que hacer o no veo lo que hago mal despues de consultar
                                          //internet foros etc...
                                            //He borrado todos los intentos nose si la proxima vez debo dejar lo que he
                                            // probado
                                                // Le quito la referencia a la imagen para que no salga el error, con
                                                // volver a poner ModeloEstablecerEstadoEstrella.php?id=$fila[mId] en
                                                //modelo listado linea 70 se redirecciona y aparece dicho error.

    $id = (int)$_REQUEST["id"];

    $sql = "UPDATE modelo SET estrella = (NOT (SELECT estrella FROM modelo WHERE id=?)) WHERE id=?";
    $select = $conexionBD->prepare($sql);
    $exito = $select->execute([$id, $id]);
    header("Location: ModeloListado.php");

?>