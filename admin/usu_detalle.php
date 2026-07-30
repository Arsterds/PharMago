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
    $stmt=$conn->prepare("Select * from clientes where cod_cliente=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $user=$stmt->get_result()->fetch_assoc();

    ?>
<!---CONSTRUCCION FORMULARIO -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DETALLADO USUARIO</title>
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
    <h2>DETALLADO USUARIO</h2>

    <p><b>NOMBRE </b><?php echo $user["nombre"];?></p> 
    <p><b>EMAIL </b><?php echo $user["email"];?></p> 
    <p><b>TELEFONO </b><?php echo $user["numero"];?></p> 
    <p><b>NUMERO </b><?php echo $user["numero"];?></p> 
    <p><b>ROL </b><?php echo $user["rol"];?></p> 
    <p><b>ESTADO </b><span class="<?php echo($user["estado"]==1) ? "Activo": "Inactivo";?>"></p>
    <br>
    <a href="usuarios_admin.php" class="btn volver"> VOLVER </a> 
</div>
        
    </body>
    </html>