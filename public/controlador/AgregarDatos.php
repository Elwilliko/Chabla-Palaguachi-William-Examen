<html>
<head>
    <meta charset="UTF-8">
    <title>Crear usuario</title>
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
$codigo = $_POST["codigo"];
$cedula = isset($_POST["cedula"]) ? mb_strtoupper(trim($_POST["cedula"]), 'UTF-8') : null;
$nombres = isset($_POST["nombres"]) ? mb_strtoupper(trim($_POST["nombres"]), 'UTF-8') : null;
$direccion= isset($_POST["direccion"]) ? mb_strtoupper(trim($_POST["direccion"]), 'UTF-8') : null;
$telefono= isset($_POST["telefono"]) ? mb_strtoupper(trim($_POST["telefono"]), 'UTF-8') : null;
$codigou = $_POST["codigou"];


$sql1 = "INSERT INTO Telefonos VALUES (0,'$cedula','$nombres','$direccion','telefono','$codigou')";


if ($conn->query($sql1) === TRUE) {
    echo "<p>Se ha creado los datos correctamemte!!!</p>";
} else {
    if($conn->errno == 1062){
        echo "<p class='error'>El numero $numero ya esta registrado en el sistema </p>";
    }else{
        echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
    }
}
echo "<a href='/hypermedial/Practica-PHP/Practica04-Mi-Agenda-Telef-nica/public/controlador/AgregarU.php?codigo=$codigo &codigou=$codigou' >Regresar</a>";
//cerrar la base de datos
$conn->close();
?>
</body>
