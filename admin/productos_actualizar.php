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
        $cod_proveedor = $_POST["cod_proveedor"];
        $precio_compra = $_POST["precio_compra"];
        $precio_venta = $_POST["precio_venta"];
        $nombre = $_POST["nombre"];
        $presentacion = $_POST["presentacion"];
        $cantidad = $_POST["cantidad"];
        $fecha_fabricacion = $_POST["fecha_fabricacion"];
        $fecha_vencimiento = $_POST["fecha_vencimiento"];
        $estado = $_POST["estado"];
    $stmt = $conn->prepare("UPDATE productos SET cod_proveedor=?, precio_compra=?, precio_venta=?, nombre=?, presentacion=?, cantidad=?, fecha_fabricacion=?, fecha_vencimiento=?, estado=? WHERE cod_productos=?");
    $stmt->bind_param("iddssisssi", $cod_proveedor, $precio_compra, $precio_venta, $nombre, $presentacion, $cantidad, $fecha_fabricacion, $fecha_vencimiento, $estado,$id);
            if($stmt->execute())
                {
                    $mensaje="Producto actualizado correctamente";
                    header("Location:productos_admin.php");
                }
        }





    //cargar datos

    $stmt=$conn->prepare("select * from productos where cod_productos=?"); //consulta todos los datos del codigo seleccionado
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
        <title>ACTUALIZAR PRODUCTO</title>
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
        <div class="container">
    <h2>EDITAR PRODUCTO</h2>
    <p class="mensaje-ok"><?php echo $mensaje;?></p>
<form method="POST" action="">

    <label>CODIGO PROVEEDOR</label>
    <input type="number" name="cod_proveedor" value="<?php echo $user['cod_proveedor']; ?>"><br>
    <label>PRECIO COMPRA</label>
    <input type="number" step="0.01" name="precio_compra" value="<?php echo $user['precio_compra']; ?>"><br>
    <label>PRECIO VENTA</label>
    <input type="number" step="0.01" name="precio_venta" value="<?php echo $user['precio_venta']; ?>"><br>
    <label>NOMBRE</label>
    <input type="text" name="nombre" value="<?php echo $user['nombre']; ?>"><br>
    <label>PRESENTACION</label>
    <select name="presentacion">
    <option value="Solido" <?php if($user['presentacion']=="solido") echo "selected"; ?>>solido</option>
    <option value="Liquido" <?php if($user['presentacion']=="liquido") echo "selected"; ?>>liquido</option>
    <option value="Semi-liquido" <?php if($user['presentacion']=="semi-liquido") echo "selected"; ?>>semi-liquido</option>
    <option value="Gaseoso" <?php if($user['presentacion']=="gaseoso") echo "selected"; ?>>gaseoso</option>
    </select><br>
    <label>CANTIDAD</label>
    <input type="number" name="cantidad" value="<?php echo $user['cantidad']; ?>"><br>
    <label>FECHA FABRICACION</label>
    <input type="date" name="fecha_fabricacion" value="<?php echo $user['fecha_fabricacion']; ?>"><br>
    <label>FECHA VENCIMIENTO</label>
    <input type="date" name="fecha_vencimiento" value="<?php echo $user['fecha_vencimiento']; ?>"><br>
    <label>ESTADO</label>
    <select name="estado">
        <option value="1" <?php if($user['estado']==1) echo "selected"; ?>>Activo</option>
        <option value="0" <?php if($user['estado']==0) echo "selected"; ?>>Inactivo</option>
    </select><br>
    <button name="actualizar">Actualizar</button>
</form>
</div>
    </body>
    </html>