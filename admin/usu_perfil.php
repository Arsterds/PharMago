<?php
session_start();
Include("../conexion.php");


if(!isset($_SESSION["usuario"]) || $_SESSION["rol"]!="admin")
    {
        header("Location:iniciarsesion.php");
        exit();
    }

    $id=$_SESSION["id"];

    $stmt=$conn->prepare("Select * from clientes where cod_cliente=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $admin=$stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRADOR</title>
    <link rel="stylesheet" href="../css/general_perfil.css">
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
    <div class="card">
    <h2>PERFIL ADMINISTRADOR </h2>
    <p><b>NOMBRE: </b><?php echo $admin ["nombre"];?></p>
    <p><b>EMAIL: </b><?php echo $admin ["email"];?></p>
    <p><b>NUMERO: </b><?php echo $admin ["numero"];?></p>
    <p><b>DOCUMENTO: </b><?php echo $admin ["documento"];?></p>
    <p><b>CONTRASEÑA</b><?php echo $admin ["contraseña"];?></p>
    <br>
    <a href="usu_editar.php" class= "btn editar">EDITAR PERFIL </a>
    <a href="usu_eliminar.php" class="btn baja" onclick="return confirm('¿Desea darse de baja?');">DARSE DE BAJA</a>
    <a href="dashboard_admin.php" class="btn volver">VOLVER </a>

</body>
</html>