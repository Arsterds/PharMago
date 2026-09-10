<?php 
session_start();
include("../../conexion.php");

if(!isset($_SESSION["usuario"]) || $_SESSION["rol"]!="admin")
    {
        header("Location:../../iniciarsesion.php");
        exit();
    }

     $id=$_GET["id"];
    $mensaje="";
    /*CARGAR DATOS CATEGORIA*/
    $categorias = $conn->query(
    "SELECT DISTINCT categoria
     FROM productos
     ORDER BY categoria"
);
$presentacion = $conn->query(
    "SELECT DISTINCT presentacion
     FROM productos
     ORDER BY presentacion"
);

/*CARGAR DATOS DEL <PRODUCTO></PRODUCTO>*/
$stmt=$conn->prepare("select * from productos where cod_productos=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

    //actualizar datos

    if(isset($_POST["actualizar"]))
        {
           
        $cod_proveedor = $_POST["cod_proveedor"];
        $precio_compra = $_POST["precio_compra"];
        $precio_venta = $_POST["precio_venta"];
        $nombre = $_POST["nombre"];
        $presentacion = $_POST["presentacion"];
        $cantidad = $_POST["cantidad"];
        $diseño = $_POST["imagen"];
        $descripcion = $_POST["descripcion"];
         $categoria = $_POST["categoria"];
        $estado = $_POST["estado"];

         /* Mantener imagen actual */
    $imagen = $user["imagen"];

    /* Si seleccionó una nueva imagen */
    if(isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0){

        $imagen = $_FILES["imagen"]["name"];

        move_uploaded_file(
            $_FILES["imagen"]["tmp_name"],
            "../img/" . $imagen
        );
    }

    $stmt = $conn->prepare
    ("UPDATE productos 
    SET cod_proveedor=?, precio_compra=?, precio_venta=?, nombre=?, presentacion=?, cantidad=?, imagen=?, descripcion=?, categoria=?, estado=? WHERE cod_productos=?");
    $stmt->bind_param("iddssissssi", $cod_proveedor, $precio_compra, $precio_venta, $nombre, $presentacion, $cantidad, $diseño, $descripcion, $categoria, $estado,$id);
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
            <a href="soporte.php" class="button">
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

    <label>CÓDIGO PROVEEDOR</label>
    <input type="number" name="cod_proveedor" value="<?php echo $user['cod_proveedor']; ?>"><br>
    <label>PRECIO COMPRA</label>
    <input type="number" step="0.01" name="precio_compra" value="<?php echo $user['precio_compra']; ?>"><br>
    <label>PRECIO VENTA</label>
    <input type="number" step="0.01" name="precio_venta" value="<?php echo $user['precio_venta']; ?>"><br>
    <label>NOMBRE</label>
    <input type="text" name="nombre" value="<?php echo $user['nombre']; ?>"><br>


   <label>PRESENTACION</label>

<select name="presentacion">

    <?php while($cat = $presentacion->fetch_assoc()) { ?>

        <option
            value="<?php echo $cat['presentacion']; ?>"
            <?php
                if($user['presentacion'] == $cat['presentacion'])
                echo "selected";
            ?>>

            <?php echo $cat['presentacion'];?>

        </option>

    <?php } ?>

</select>

<br>

    <label>CANTIDAD</label>
    <input type="number" name="cantidad" value="<?php echo $user['cantidad']; ?>"><br>
    <label>IMAGEN ACTUAL</label><br>
             <img src="../../imagenes/<?php echo trim($user['imagen']);?>" width="150">
        
<br><br>
<input
    type="hidden"
    name="imagen_actual"
    value="<?php echo $user['imagen']; ?>">

<label>Cambiar Imagen</label>

<input
    type="file"
    name="imagen">

<br>

    <br>

    <label>DESCRIPCION</label>
    <input type="text" name="descripcion" value="<?php echo $user['descripcion']; ?>"><br>
    <label>CATEGORIA</label>
    <input type="text" name="categoria" value="<?php echo $user['categoria']; ?>"><br>
    <label>ESTADO</label>
    <select name="estado">
        <option value="activo" <?php if($user['estado']=="activo") echo "selected"; ?>>Activo</option>
        <option value="desactivado" <?php if($user['estado']=="desactivado") echo "selected"; ?>>Inactivo</option>
    </select><br>
    <button name="actualizar">Actualizar</button>
</form>
</div>
    </body>
    </html>