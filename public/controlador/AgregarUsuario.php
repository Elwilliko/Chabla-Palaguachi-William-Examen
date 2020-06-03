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


