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
            $nombre=$_POST["nombre"];
            $apellido=$_POST["apellido"];
            $usuario=$_POST["usuario"];
            $email=$_POST["email"];
            $numero=$_POST["numero"];
            $documento=$_POST["documento"];
            $rol=$_POST["rol"];
            $estado=$_POST["estado"];
            $stmt=$conn->prepare("update clientes set nombre=?,apellido=?,usuario=?,email=?,numero=?,documento=?,rol=?,estado=? where cod_cliente=?");
            $stmt->bind_param("ssssssssi",$nombre,$apellido,$usuario,$email,$numero,$documento,$rol,$estado,$id);
            if($stmt->execute())
                {
                    $mensaje="Usuario actualizado correctamente";
                    header("Location:usuarios_admin.php");
                }
        }





    //cargar datos

    $stmt=$conn->prepare("select * from clientes where cod_cliente=?"); //consulta todos los datos del codigo seleccionado
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
         <link rel="stylesheet" href="../css/general.css">
         
    </head>
 <header>
        <div class="contenedor">
            <img src="imagenes/logo.png" alt="Logo PharMago">
        </div>
        <div class="contenedor1">
            <a href="./php/soporte.php" class="button">
                CONTACTAR AL SOPORTE
            </a>
        </div>
        <h1>PharMago</h1>
        <nav>
            
            <a href="iniciarsesion.php">INICIAR SESIÓN</a>
        </nav>
    </header>


    <body>
        <div class="container">
    <h2>EDITAR USUARIO</h2>
    <p class="mensaje-ok"><?php echo $mensaje;?></p>
    <form method="POST" action="">
    <label>NOMBRE</label> <input type="text" name="nombre" value="<?php echo $user["nombre"];?>"><br>
    <label>APELLIDO</label> <input type="text" name="apellido" value="<?php echo $user["apellido"];?>"><br>
    <label>USUARIO</label> <input type="text" name="usuario" value="<?php echo $user["usuario"];?>"><br>
    <label>EMAIL</label> <input type="text" name="email" value="<?php echo $user["email"];?>"><br>
    <label>NUMERO</label> <input type="number" name="numero" value="<?php echo $user["numero"];?>"><br>
    <label>DOCUMENTO</label> <input type="number" name="documento" value="<?php echo $user["documento"];?>"><br>
    <label>ROL</label> <select name="rol"><option value="admin" <?php if($user["rol"]=="admin") echo "selected";?>>Admin</option>
    <option value="cliente" <?php if($user["rol"]=="cliente") echo "selected";?>>Cliente</option></select><br>    
    <label>ESTADO</label> <select name="estado"><option value="1" <?php if($user["estado"]==1) echo "selected";?>>Activo</option>
    <option value="0" <?php if($user["estado"]==0) echo "selected";?>>Inactivo</option></select><br>    
    <button name="actualizar"> Actualizar </button>
</form>
</div>
    </body>
    </html>