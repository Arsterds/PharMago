<?php 
session_start();
include("../conexion.php");

if(!isset($_SESSION["usuario"]) || $_SESSION["rol"]!="admin")
    {
        header("Location:iniciarsesion.php");
        exit();
    }

    $id=$_GET["id"];
    //cargar datos de la base 
    $stmt=$conn->prepare("Select * from productos where cod_productos=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $medicamento=$stmt->get_result()->fetch_assoc();

    ?>
<!---CONSTRUCCION FORMULARIO -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DETALLADO PRODUCTO</title>
         <link rel="stylesheet" href="../css/general.css">
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
        <div class="detalle">
    <h2>DETALLADO PRODUCTO</h2>

    <p><b>CÓDIGO PRODUCTO </b><?php echo $medicamento["cod_productos"]; ?></p>
    <p><b>CÓDIGO PROVEEDOR </b><?php echo $medicamento["cod_proveedor"]; ?></p>
    <p><b>PRECIO COMPRA </b><?php echo $medicamento["precio_compra"]; ?></p>
    <p><b>PRECIO VENTA </b><?php echo $medicamento["precio_venta"]; ?></p>
    <p><b>NOMBRE </b><?php echo $medicamento["nombre"]; ?></p>
    <p><b>PRESENTACIÓN </b><?php echo $medicamento["presentacion"]; ?></p>
    <p><b>CANTIDAD </b><?php echo $medicamento["cantidad"]; ?></p>
    <p><b>FECHA FABRICACIÓN </b><?php echo $medicamento["fecha_fabricacion"]; ?></p>
    <p><b>FECHA VENCIMIENTO </b><?php echo $medicamento["fecha_vencimiento"]; ?></p>
    <p>
    <b>ESTADO </b>
    <span class="<?php echo ($medicamento["estado"] == 1) ? "activo" : "inactivo"; ?>">
        <?php echo ($medicamento["estado"] == 1) ? "Activo" : "Inactivo"; ?>
    </span>
    </p>

    <br>
    <a href="productos_admin.php" class="btn volver"> VOLVER </a> 
</div>
        
    </body>
    </html>