<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONSULTA PROVEEDORES</title>

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


</head>

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
            $activos=$conn->query("Select * from proveedores where estado=1");
            $inactivos=$conn->query("Select * from proveedores where estado=0");
            $usuarios=$conn->query("Select * from proveedores");

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
    <h2 style="text-align:center; ">LISTADO DE PROVEEDORES </h2>
    <table border="1" width="80%" align="center">
        <tr><th>COD_PROVEEDOR</th><th>CORREO_CONTACTO</th><th>NOMBRE_REPRESENTANTE</th><th>DIRECCION</th><th>ACCION</th></tr>
         <?php while($row= $activos->fetch_assoc())
         {
            ?>
            <tr>
            <td><?php echo $row["cod_proveedor"];?></td>
            <td><?php echo $row["correo_contacto"];?></td>
            <td><?php echo $row["nombre_representante"];?></td>
            <td><?php echo $row["direccion_empresa"];?></td>
            <td><a href="proveedores_actualizar.php?id=<?php echo $row['cod_proveedor'];?>">EDITAR</a> | <a href="proveedor_eliminar.php?id=<?php echo $row['cod_proveedor'];?>onclick="return confirm('Desea dar de baja este usuario?');'"> DESACTIVAR</a> | <a href="proveedores_detalle.php?id=<?php echo $row['cod_proveedor'];?>">DETALLADO</a></td></tr>
         <?php } ?>
    </table>
<br></br>
 <h2 style="text-align:center; ">LISTADO DE PROVEEDORES DESHABILITADOS </h2>
 <table border="1" width="80%" align="center">
        <tr><th>COD_PROVEEDOR</th><th>CORREO_CONTACTO</th><th>NOMBRE_REPRESENTANTE</th><th>DIRECCION</th><th>ACCION</th></tr>
        <?php while($row= $inactivos->fetch_assoc())
        {
            ?>
            <tr>
            <td><?php echo $row["cod_proveedor"];?></td>
            <td><?php echo $row["correo_contacto"];?></td>
            <td><?php echo $row["nombre_representante"];?></td>
            <td><?php echo $row["direccion_empresa"];?></td>
            <td><a href="proveedor_activar.php?id=<?php echo $row['cod_proveedor'];?>">ACTIVAR</a> </td></tr>
        <?php } ?>
    </table>
    <br>
    <div class="footer">
    <a href="dashboard_admin.php">VOLVER</a>
</div>

</body>
</html>