<?php
include "dMathClass.php";

$json = $_POST['json'];
echo "el resultado es : ".dMath::calc($json);
?>

<a href="index.php"><button type="button" name="button">volvera calcular</button></a>
