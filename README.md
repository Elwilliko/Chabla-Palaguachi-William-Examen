# Chabla-Palaguachi-William-Examen

Se crea la base de datos de nombre parqueadero además se tiene las tablas de usuario, ticket y vehículo donde se hace una clave foránea de usuario y en la tabla ticket se crea una clave foránea vehículos. 

Datos:
 
 ![Alt text](https://github.com/Elwilliko/Chabla-Palaguachi-William-Examen/blob/e6a839ecab7e082ae7da557772f3e0ad970d7b38/imag/foring.png "Optional title")
 
 

•	Código
Se realiza la creación de index.html.
Se realiza un estilo de parqueadero de la UPS, con el index.css

  ![Alt text](https://github.com/Elwilliko/Chabla-Palaguachi-William-Examen/blob/e6a839ecab7e082ae7da557772f3e0ad970d7b38/imag/index.jpg "Optional title")

  ![Alt text](https://github.com/Elwilliko/Chabla-Palaguachi-William-Examen/blob/e6a839ecab7e082ae7da557772f3e0ad970d7b38/imag/login.jpg "Optional title")
  
Al dar click en la imagen nos lleva a Login.html, donde llenaremos los datos
 
Logon.php es donde se comprueba si los datos fueron ingresados correctamente
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

aquí se genero un error en tic_codigo; proveniente de la base de datos de la clave foránea
Buscar.js: es para buscar mediante Ajax

function buscarUsuario(){
    new URLSearchParams(Location.search);
    var cedula = params.get('cedula');
    if (correo == "") {
        document.getElementById("usu").innerHTML = "";
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert("llegue");
                document.getElementById("usu").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","/../Chabla-Palaguachi-William-Examen/public/vista/User.php?usuario="+cedula,true);
        xmlhttp.send();
    }
    return false;
}

User.php se el encargado de dar valido a la búsqueda para poder de esta manera copilar los datos mediante las llaves foráneas se puedan copilar a los datos del ticket ingresados con anterioridad.
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


AgregarUsuario: se utiliza para agregar nuevos usuarios 
<!DOCTYPE html>
<html style="
    background: beige; ">
<head>
    <meta charset="UTF-8">
    <title>Agregar Telefonos Usuario</title>
    <link rel="stylesheet" href ="../vista/tabla.css" type="text/css" />
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
        <a href="/../Chabla-Palaguachi-William-Examen/index.html"><input type="button" id="btnInicio" value="Inicio" style="float: right; width: 20%;display: inline-block;border-radius: 4px;background-color: chartreuse;border: none;color: #FFFFFF;text-align: center;font-size: 28px;padding: 20px;width: 200px;transition: all 0.5s;cursor: pointer;margin: 5px;cursor: pointer;display: inline-block;position: relative;transition: 0.5s;margin-left: 174px;margin-top: -231px;"></a>
    </div>
    <br>
    <br>
    <br>
    <div class="boton">
        <a href="/../Chabla-Palaguachi-William-Examen/index.html"><input type="button" id="btnInicio" value="Inicio" style="float: right; width: 20%;display: inline-block;border-radius: 4px;background-color: chartreuse;border: none;color: #FFFFFF;text-align: center;font-size: 28px;padding: 20px;width: 200px;transition: all 0.5s;cursor: pointer;margin: 5px;cursor: pointer;display: inline-block;position: relative;transition: 0.5s;margin-left: 174px;margin-top: -159px;"></a>
    </div>
</header>
<?php
$codigo = $_GET["codigo"];
$codigou = $_GET["codigou"];
$sql = "SELECT * FROM usuario WHERE usu_codigo = $codigo AND tel_usu_codigo= $codigou";
include '../../config/ConexionBD.php';
$result = $conn->query($sql);

if ($result->num_rows > 0) {


    while($row = $result->fetch_assoc()) {

        ?>





        <aside>
            <h2  style="
    text-align: center;
">Formulario</h2>
            <!--<form id="formulario01" method="POST" onsubmit="return validar()||EntrarPHP() " action="/hypermedial/Practica-PHP/Practica04-Mi-Agenda-Telef-nica/public/controlador/crear_usuario.php" >-->
            <form id= "formulario" method="POST" action="/public/controlador/AgregarDatos.php">
                <fieldset style="
    WIDTH: 50%;
    margin-top: 112px;
    margin-left: 375px;
">
                    <legend>Insertar:</legend>
                    <br>
                    <br>
                    <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>" />
                    <div><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;cedula:</label><input type='text' id="cedula" name= "cedula" value= ""></div><br>
                    <div><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;nombres:</label><input type='text' id="nombres" name= "nombres" value=""></div><br>
                    <div><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;direccion:</label><input type='text' id="direccion" name="direccion" value=""></div><br>
                    <div><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;telefono:</label><input type='text' id="telefono" name="telefono" value=""></div><br>

                    <input type="hidden" id="codigou" name="codigou" value="<?php echo $codigou ?>" />
                    <input type="submit"  id="btnValidar"  value="Aceptar" style="float: right;width: 20%;">

                    <br><br>

                </fieldset>
            </form>
            <spam id="p" style="display: none;">error</spam>
        </aside>
        <?php
    }

} else {
    echo "<p>Ha ocurrido un error inesperado !</p>";
    echo "<p>" . mysqli_error($conn) . "</p>";
}
$conn->close();
?>


</body>


AgregarDatos: son los datos donde se le asigna mediante una sentencia. 
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

Tablas.CSS para los campos de la tablas 
th, td {
    width: 25%;
    text-align: center;
    vertical-align: top;
    border: 2px solid #000;
    row-gap: 2;
    column-span: 3;
    border-spacing: 2;
    padding-block-end: 2;

}

Estos serian los campos pero aun falto culminar para la demostración de dichos datos.
