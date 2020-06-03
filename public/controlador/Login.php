<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Colocar Datos</title>
    <style type="text/css" rel="stylesheet">
        .error{
            color: red;
        }
    </style>
</head>
<body>

<?php
//incluir conexión a la base de datos
include '../../config/ConexionBD.php';

$numero = isset($_POST["numero"]) ? trim($_POST["numero"]) : null;
$fecha = isset($_POST["fecha"]) ? mb_strtoupper(trim($_POST["fecha"]), 'UTF-8') : null;
$hora= isset($_POST["hora"]) ? mb_strtoupper(trim($_POST["hora"]), 'UTF-8') : null;
$placa = isset($_POST["placa"]) ? mb_strtoupper(trim($_POST["placa"]), 'UTF-8') : null;
$marca = isset($_POST["marca"]) ? trim($_POST["marca"]): null;
$modelo = isset($_POST["modelo"]) ? trim($_POST["modelo"]) : null;


$maxval = $conn->query("SELECT tic_codigo FROM ticket WHERE tic_codigo=(SELECT max(tic_codigo) FROM ticket)");

while ($row = $maxval->fetch_assoc()) {
    $tic_codigo = $row['tic_vei_codigo'];
}
$tic_codigo+=1;
echo($tic_codigo);



$sql = "INSERT INTO ticket VALUES (0, '$numero', '$fecha', '$hora')";
$sql1 = "INSERT INTO vehiculos VALUES (0,'$placa','$marca','$modelo','$tic_codigo')";


if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
    echo "<p>Se ha creado los datos personales correctamemte!!!</p>";
} else {

        echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
}

//cerrar la base de datos
$conn->close();
?>
</body>
