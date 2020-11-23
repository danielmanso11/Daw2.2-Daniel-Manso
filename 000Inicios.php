<html>
<head></head>
<body>
<?php
    $contador = (int)>$_REQUEST("CONTADOR");
    $cantidad_mundos = 5+5;

?>


<p>Holan ,mundo nº <?php echo $cantidad_mundos ?></p>
<p>Holan ,mundo nº <?= $cantidad_mundos ?></p> //Es lo mismo pero al usarse tantas veces es una expresion para simplificar


</body>
</html>