<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONSULTA soporte</title>
<link rel="stylesheet" href="../css/general_admin.css">
</head>
<header>
        <div class="contenedor">
            <img src="../imagenes/logo.png" alt="Logo PharMago">
        </div>
        <div class="contenedor1">
            <a href="../php/soporte.php" class="button">
                CONTACTAR AL SOPORTE
            </a>
        </div>
        <h1>PharMago</h1>
        <nav>
      
            <a href="../iniciarsesion.php">INICIAR SESIÓN</a>
        </nav>
    </header>
<body>
    <!---CONSTRUCCION LOGICA EN PHP-->
        <?php
            session_start();
            Include("../conexion.php");

            If (!isset($_SESSION["usuario"]) || $_SESSION["rol"]!="admin")
                {
                    header("Location:iniciarsesion.php");
                    exit();
                }
            // consulta de usuarios
            $realizados=$conn->query("Select * from mensajes where estado='Realizado'");
            $pendientes=$conn->query("Select * from mensajes where estado='Pendiente'");
            $activos=$conn->query("Select * from mensajes where estado='Activo'");
            $inactivos=$conn->query("Select * from mensajes where estado='Inactivo'");

            $usuarios=$conn->query("Select * from mensajes");

            //mensajes
            if(isset($_GET["msg"]))
                {
                    if($_GET["msg"]=="eliminado")
                        {
                            echo "<p style='text-align:center;color:red; Font-weight:bold; '>Usuario Eliminado Correctamente </p>";
                        }
                    if($_GET["msg"]=="activado")
                        {
                            echo "<p style='text-align:center;color:green; Font-weight:bold;'>Usuario Habilitado Correctamente </p>";
                        }
                }
            $conn->close();
         ?>


    <!---CONSTRUCCION HTML -->
    <h2 style="text-align:center; ">SOPORTE ACTIVO </h2>
    <table border="1" width="80%" align="center">
        <tr><th>COD_MENSAJE</th><th>COD_USUARIO</th><th>MENSAJE</th><th>ACCION</th></tr>
         <?php while($row= $activos->fetch_assoc())
         {
            ?>
            <tr>
            <td><?php echo $row["cod_mensaje"];?></td>
            <td><?php echo $row["cod_cliente"];?></td>
            <td><?php echo $row["mensaje"];?></td>
            <td><a href="soporte_actualizar.php?id=<?php echo $row['cod_mensaje'];?>">EDITAR ESTADO</a></td>
        </tr>
        <?php } ?>
    </table>

        <h2 style="text-align:center; ">SOPORTES PENDIENTES</h2>
    <table border="1" width="80%" align="center">
        <tr><th>COD_MENSAJE</th><th>COD_USUARIO</th><th>MENSAJE</th><th>ACCION</th></tr>
         <?php while($row= $pendientes->fetch_assoc())
         {
            ?>
            <tr>
            <td><?php echo $row["cod_mensaje"];?></td>
            <td><?php echo $row["cod_cliente"];?></td>
            <td><?php echo $row["mensaje"];?></td>
            <td><a href="soporte_actualizar.php?id=<?php echo $row['cod_mensaje'];?>">EDITAR ESTADO</a></td>
        </tr>
         <?php } ?>
    </table>

        <h2 style="text-align:center; ">SOPORTES REALIZADOS</h2>
    <table border="1" width="80%" align="center">
        <tr><th>COD_MENSAJE</th><th>COD_USUARIO</th><th>MENSAJE</th><th>ACCION</th></tr>
         <?php while($row= $realizados->fetch_assoc())
         {
            ?>
            <tr>
            <td><?php echo $row["cod_mensaje"];?></td>
            <td><?php echo $row["cod_cliente"];?></td>
            <td><?php echo $row["mensaje"];?></td>
            <td><a href="soporte_actualizar.php?id=<?php echo $row['cod_mensaje'];?>">EDITAR ESTADO</a></td>
            <?php } ?>
        </tr>
    </table>

<br></br>
 <h2 style="text-align:center; ">SOPORTES DESHABILITADOS </h2>
 <table border="1" width="80%" align="center">
        <tr><th>COD_MENSAJE</th><th>COD_USUARIO</th><th>MENSAJE</th><th>ACCION</th></tr>
        <?php while($row= $inactivos->fetch_assoc())
        {
            ?>
            <tr>
                <td><?php echo $row["cod_mensaje"];?></td>
            <td><?php echo $row["cod_cliente"];?></td>
            <td><?php echo $row["mensaje"];?></td>
            <td><a href="soporte_actualizar.php?id=<?php echo $row['cod_mensaje'];?>">EDITAR ESTADO</a></td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <div class="footer">
    <a href="dashboard_admin.php">VOLVER</a>
</div>

</body>
</html>