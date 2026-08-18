<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONSULTA productos</title>
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
            $activos=$conn->query("Select * from productos where estado=1");
            $inactivos=$conn->query("Select * from productos where estado=0");
            $usuarios=$conn->query("Select * from productos");

            //mensajes
            if(isset($_GET["msg"]))
                {
                    if($_GET["msg"]=="eliminado")
                        {
                            echo "<p style='text-align:center;color:red; Font-weight:bold; '>Producto Eliminado Correctamente </p>";
                        }
                    if($_GET["msg"]=="activado")
                        {
                            echo "<p style='text-align:center;color:green; Font-weight:bold;'>Producto Habilitado Correctamente </p>";
                        }
                }
            $conn->close();
         ?>


    <!---CONSTRUCCION HTML -->
    <h2 style="text-align:center; ">LISTADO DE PRODUCTOS </h2>
    <table border="1" width="80%" align="center">
        <tr><th>COD_PRODUCTOS</th><th>NOMBRE</th><th>PRESENTACION</th><th>CANTIDAD</th><th>ACCION</th></tr>
         <?php while($row= $activos->fetch_assoc()) 
         {
            ?>
            <tr>
                <td><?php echo $row["cod_productos"];?></td>
            <td><?php echo $row["nombre"];?></td>
            <td><?php echo $row["presentacion"];?></td>
            <td><?php echo $row["cantidad"];?></td>
            <td><a href="productos_actualizar.php?id=<?php echo $row['cod_productos'];?>">EDITAR</a> | <a href="productos_eliminar.php?id=<?php echo $row['cod_productos'];?>onclick="return confirm('Desea dar de baja este usuario?');'"> DESACTIVAR</a> | <a href="productos_detalle.php?id=<?php echo $row['cod_productos'];?>">DETALLADO</a></td></tr>
         <?php } ?>
    </table>
<br></br>
 <h2 style="text-align:center; ">LISTADO DE USUARIOS DESHABILITADOS </h2>
 <table border="1" width="80%" align="center">
         <tr><th>COD_PRODUCTOS</th><th>NOMBRE</th><th>PRESENTACION</th><th>CANTIDAD</th><th>ACCION</th></tr>
        <?php while($row= $inactivos->fetch_assoc())
        {
            ?>
            <tr>
            <td><?php echo $row["cod_productos"];?></td>
            <td><?php echo $row["nombre"];?></td>
            <td><?php echo $row["presentacion"];?></td>
            <td><?php echo $row["cantidad"];?></td>
            <td><a href="productos_activar.php?id=<?php echo $row['cod_productos'];?>">ACTIVAR</a> </td></tr>
        <?php } ?>
    </table>
    <br>
    <div class="footer">
    <a href="dashboard_admin.php">VOLVER</a>
</div>

</body>
</html>