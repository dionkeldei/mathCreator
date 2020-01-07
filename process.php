<?php
include "src/dMath.php";

$json = $_POST['json'];
$var1 = $_POST['var1'];
$json = str_replace("x",$var1,$json);
echo "the return is : ".dMath::calc($json);
?>

<a href="index.php"><button type="button" name="button">Again</button></a>
