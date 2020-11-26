<html>
<head></head>
<body>      
    <select>
        <?php for( $cont = 1; $cont <=5 ; $cont++){ ?>
        <option> <?= $cont ?> </option> //Con id para luego pocder enviarlo a un formulario
        <?php } ?>
    </select> 
</body>
</html>