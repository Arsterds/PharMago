<?php 
session_start();
include("../conexion.php");

if(!isset($_SESSION["usuario"]) || $_SESSION["rol"]!="admin")
    {
        header("Location:iniciarsesion.php");
        exit();
    }

    $id=$_GET["id"];
    $mensaje="";

    //actualizar datos

    if(isset($_POST["actualizar"]))
        {
            $mensaje_usu=$_POST["mensaje"];
            $estado=$_POST["estado"];
            $stmt=$conn->prepare("update mensajes set mensaje=?,estado=? where cod_mensaje=?");
            $stmt->bind_param("ssi",$mensaje_usu,$estado,$id);
            if($stmt->execute())
                {
                    $mensaje="Mensaje actualizado correctamente";
                    header("Location:soporte_admin.php");
                    exit();
                }
        }





    //cargar datos

    $stmt=$conn->prepare("select * from mensajes where cod_mensaje=?"); //consulta todos los datos del codigo seleccionado
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $user=$stmt->get_result()->fetch_assoc(); //almacena el resultado en la variable user para luego ser cargado en el formulario


?>
    <!---CONSTRUCCION FORMULARIO -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ACTUALIZAR USUARIO</title>
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
        <div class="container">
    <h2>EDITAR MENSAJE</h2>
    <p class="mensaje-ok"><?php echo $mensaje;?></p>
    <form method="POST" action="">
    <label>MENSAJE</label> <input type="text" name="mensaje" value="<?php echo $user["mensaje"];?>"><br>
    <label>ESTADO</label> <select name="estado">
    <option value="Realizado" <?php if($user["estado"]=='Realizado') echo "selected";?>>Realizado</option>
    <option value="Pendiente" <?php if($user["estado"]=="Pendiente") echo "selected";?>>Pendiente</option>
    <option value="Activo" <?php if($user["estado"]=="Activo") echo "selected";?>>Activo</option>
    <option value="Inactivo" <?php if($user["estado"]=="Inactivo") echo "selected";?>>Inactivo</option></select><br>    
    <button name="actualizar"> Actualizar </button>
</form>
</div>
    </body>
    </html>