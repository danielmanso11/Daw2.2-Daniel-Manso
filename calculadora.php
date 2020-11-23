<?php
    $operando1 = $_REQUEST['operando1'];
    $operando2 = $_REQUEST['operando2'];
    $operador = $_REQUEST['operador'];

        if($operador == "+"){
            $solucion = $operando1 + $operando2;
        }else if($operador == "-"){
            $solucion = $operando1 - $operando2;
        }else if($operador == "*"){
            $solucion = $operando1 * $operando2;
        }else if($operador == "/"){
            if($operando2 == 0){
                echo "Error en la division ";
            }
            else {
                $solucion = $operando1 / $operando2;
                }
        }
            if(isset($solucion)){
                echo "El resultado es: " . $solucion;
            }

?>