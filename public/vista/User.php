<!DOCTYPE html>
<html style="
    background: beige; ">
<head>
    <meta charset="UTF-8">
    <title>Gestión de usuarios</title>
    <link rel="stylesheet" href ="/hypermedial/Practica-PHP/Practica04-Mi-Agenda-Telef-nica/public/vista/tabla.css" type="text/css" />
</head>
<body>
<header style="
    background: #afbdb363;
    height: 118px;
">
    <div class="logo">
        <nav>
            <a href="https://www.ups.edu.ec/sede-cuenca"><img src="https://www.pequeciencia.ups.edu.ec/imgcontenidos/2-3_Logo%20UPS.png" alt="logo" height="100" width="200"> </a>

        </nav>

    </div>
    <br>
    <div class="boton">
        <a href="/hypermedial/Practica-PHP/Practica04-Mi-Agenda-Telef-nica/index.html"><input type="button" id="btnInicio" value="Inicio" style="float: right; width: 20%;display: inline-block;border-radius: 4px;background-color: chartreuse;border: none;color: #FFFFFF;text-align: center;font-size: 28px;padding: 20px;width: 200px;transition: all 0.5s;cursor: pointer;margin: 5px;cursor: pointer;display: inline-block;position: relative;transition: 0.5s;margin-left: 174px;margin-top: -231px;"></a>
    </div>
    <br>
    <br>
    <br>
    <div class="boton">
        <a href="/hypermedial/Practica-PHP/Practica04-Mi-Agenda-Telef-nica/.html"><input type="button" id="btnInicio" value="Inicio" style="float: right; width: 20%;display: inline-block;border-radius: 4px;background-color: chartreuse;border: none;color: #FFFFFF;text-align: center;font-size: 28px;padding: 20px;width: 200px;transition: all 0.5s;cursor: pointer;margin: 5px;cursor: pointer;display: inline-block;position: relative;transition: 0.5s;margin-left: 174px;margin-top: -159px;"></a>
    </div>
    <a href="listarTelfAnonimo.html"><input type="button" id="btnBuscar" value="Buscar Telefono" style="float: right; width: 20%;display: inline-block;border-radius: 4px;background-color: chartreuse;border: none;color: #FFFFFF;text-align: center;font-size: 28px;padding: 20px;width: 233px;transition: all 0.5s;cursor: pointer;margin: 5px;cursor: pointer;display: inline-block;position: relative;transition: 0.5s;margin-left: 174px;"></a>
</header>

<?php
//incluir conexión a la base de datos
include '../../config/ConexionBD.php';
//echo "Hola " . $cedula;
$correo= $_GET['correo'];
$sql = "SELECT u.usu_cedula,u.usu_nombres,u.usu_apellidos,u.usu_correo,u.usu_contrasena,t.tel_numero,t.tel_tipo,t.tel_codigo,t.tel_usu_codigo,u.usu_codigo
         from usuario u , Telefonos t
         where u.usu_codigo = t.tel_usu_codigo
         And u.usu_correo ='$correo'";


//cambiar la consulta para puede buscar por ocurrencias de letras
$result =$conn->query($sql);
echo " <table style='width:100%'>
 <tr>
 <th>Cedula</th>
 <th>Nombres</th>
 <th>Apellidos</th>
 <th>Correo</th>
 <th>Contraseña</th>
 <th>Telefono</th>
 <th>Tipo</th>
 <th>Agregar Telefono</th>
 <th>Modificar Telefono</th>
 <th>Eliminar Telefono</th>
 <th>Modificar Contraseña</th>
 <th>Eliminar Contraseña</th>
 <th>Modificar Usuario</th>
 </tr>";

if ($result->num_rows > 0 ) {

    while($row = $result->fetch_assoc()) {
        echo "<tr>";

        echo " <td style=text-align:center>" . $row['usu_cedula'] ."</td>";

        echo " <td style=text-align:center>" . $row['usu_nombres'] ."</td>";

        echo " <td style=text-align:center>" . $row['usu_apellidos'] . "</td>";

        echo " <td style=text-align:center>" . $row['usu_correo'] ."</td>";

        echo " <td style=text-align:center>" . $row['usu_contrasena'] ."</td>";

        echo " <td style=text-align:center>" . $row['tel_numero'] . "</td>" ;"<br>";

        echo " <td style=text-align:center>" . $row['tel_tipo'] . "</td>" ;"<br>";

        $codigo = $row['tel_codigo'];
        $codigou = $row['tel_usu_codigo'];
        echo " <td> <a href='/hypermedial/Practica-PHP/Practica04-Mi-Agenda-Telef-nica/public/controlador/AgregarU.php?codigo=" . $codigo . "&codigou=" . $codigou  . "'>Agregar numero</a> </td>";

        echo " <td> <a href='/hypermedial/Practica-PHP/Practica04-Mi-Agenda-Telef-nica/public/controlador/modificarU.php?codigo=" . $row['tel_codigo'] . "'>Modificar numero</a> </td>";

        echo " <td> <a href='/hypermedial/Practica-PHP/Practica04-Mi-Agenda-Telef-nica/public/controlador/eliminarU.php?codigo=" . $row['tel_codigo'] . "'>Eliminar numero</a> </td>";

        echo " <td> <a href='/hypermedial/Practica-PHP/Practica04-Mi-Agenda-Telef-nica/public/controlador/modificarContraU.php?codigo=" . $row['usu_codigo'] . "'>Modificar Contraseña </a> </td>";

        echo " <td> <a href='/hypermedial/Practica-PHP/Practica04-Mi-Agenda-Telef-nica/public/controlador/eliminarCU.php?codigo=" . $row['usu_codigo'] . "'>Eliminar Usuario </a> </td>";

        echo " <td> <a href='/hypermedial/Practica-PHP/Practica04-Mi-Agenda-Telef-nica/public/controlador/modificarUser.php?codigo=" . $row['usu_codigo'] . "'>Modificar Usuario </a> </td>";
        echo "</tr>";
    }
}else{
    echo "<tr>";
    echo " <td colspan='7'> No existen usuarios registradas en el sistema </td>";
    echo "</tr>";
}

echo "</table>";
$conn->close();

?>
<footer id="piepagina" style="
    margin-top: 299px;
    clear: both;
    border: rgb(86, 87, 143);
    padding: 0px;
    border-bottom: outset;
    border-color: darkslategrey;
    border-top: 2px solid black;
    background-color: #afbdb363;
">
    Cargatodo • 411 Azuay Kevin AZ  • 07-411-46-47<br>
    <p>Gracias por visitarnos <em>Vuelva pronto</em></p>
    <p>Última Actualización:
        <time datetime="2020-04-23">Abril 23 2020 8:25 p.m.</time></p>
    <p><cite>Kevin Godoy Mendía @2020 Derechos Reservados</cite></p>
</footer>
<script src="../controlador/buscaruser.js"></script>
</body>


