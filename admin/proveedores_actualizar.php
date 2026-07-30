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
            $correo_contacto=$_POST["correo_contacto"];
            $nombre_representante=$_POST["nombre_representante"];
            $numero_telefono_representante=$_POST["numero_telefono_representante"];
            $correo=$_POST["correo"];
            $direccion_empresa=$_POST["direccion_empresa"];
            $plazo=$_POST["plazo"];
            $razon_social=$_POST["razon_social"];
            $estado=$_POST["estado"];
            $stmt=$conn->prepare("update proveedores set correo_contacto=?,nombre_representante=?,numero_telefono_representante=?,correo=?,direccion_empresa=?,plazo=?,razon_social=?,estado=? where cod_proveedor=?");
            $stmt->bind_param("ssssssssi",$correo_contacto,$nombre_representante,$numero_telefono_representante,$correo,$direccion_empresa,$plazo,$razon_sociall,$estado,$id);
            if($stmt->execute())
                {
                    $mensaje="Usuario actualizado correctamente";
                    header("Location:proveedores_admin.php");
                }
        }





    //cargar datos

    $stmt=$conn->prepare("select * from proveedores where cod_proveedor=?"); //consulta todos los datos del codigo seleccionado
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
        <title>ACTUALIZAR PROVEEDOR</title>
    </head>
    <body>
        <div class="container">
    <h2>EDITAR PROVEEDOR</h2>
    <p class="mensaje-ok"><?php echo $mensaje;?></p>
    <form method="POST" action="">
    <label>CORREO CONTACTO</label> <input type="text" name="correo_contacto" value="<?php echo $user["correo_contacto"];?>"><br>
    <label>NOMBRE REPRESENTANTE</label> <input type="text" name="nombre_representante" value="<?php echo $user["nombre_representante"];?>"><br>
    <label>NUMERO TELEFONO REPRESENTANTE</label> <input type="text" name="numero_telefono_representante" value="<?php echo $user["numero_telefono_representante"];?>"><br>
    <label>CORREO</label> <input type="text" name="correo" value="<?php echo $user["correo"];?>"><br>
    <label>DIRECCION EMPRESA</label> <input type="text" name="direccion_empresa" value="<?php echo $user["direccion_empresa"];?>"><br>
    <label>PLAZO</label> <input type="text" name="plazo" value="<?php echo $user["plazo"];?>"><br>
    <label>RAZON SOCIAL</label> <input type="text" name="razon_social" value="<?php echo $user["razon_social"];?>"><br>
    <label>ESTADO</label> <select name="estado"><option value="1" <?php if($user["estado"]==1) echo "selected";?>>Activo</option>
    <option value="0" <?php if($user["estado"]==0) echo "selected";?>>Inactivo</option></select><br>    
    <button name="actualizar"> Actualizar </button>
</form>
</div>
    </body>
    </html>