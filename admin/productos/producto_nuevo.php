<?php

session_start();
include("../../conexion.php");

if(!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "admin"){
    header("Location: ../iniciosesion.php");
    exit();
}

$mensaje = "";

if(isset($_POST["guardar"])){

     
           
        $cod_proveedor = $_POST["cod_proveedor"];
        $precio_compra = $_POST["precio_compra"];
        $precio_venta = $_POST["precio_venta"];
        $nombre = $_POST["nombre"];
        $presentacion = $_POST["presentacion"];
        $cantidad = $_POST["cantidad"];
        $diseño = $_POST["imagen"];
        $descripcion = $_POST["descripcion"];
         $categoria = $_POST["categoria"];
       

    $imagen = "";

    if(
        isset($_FILES["imagen"]) &&
        $_FILES["imagen"]["error"] == 0
    ){

        $imagen = time() . "_" .
        $_FILES["imagen"]["name"];

        move_uploaded_file(
            $_FILES["imagen"]["tmp_name"],
            "../../imagenes/" . $imagen
        );
    }

    $estado = 'activo';

    $stmt = $conn->prepare(
        "INSERT INTO productos
        (
            cod_proveedor, precio_compra, precio_venta, nombre, presentacion, cantidad, imagen, descripcion, categoria,
            estado
        )
        VALUES
        (
            ?, ?, ?, ?, ?, ?, ?,?,?,?
        )"
    );

    $stmt->bind_param(
        "iddssissss",
        $cod_proveedor,
        $precio_compra,
        $precio_venta,
        $nombre,
        $presentacion,
        $cantidad,
        $imagen,
        $descripcion,
        $categoria,
        $estado
    );

    if($stmt->execute()){

        header("Location: productos_admin.php");
        exit();

    }else{

        $mensaje =
        "Error al registrar producto";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nuevo Producto</title>
<link rel="stylesheet" href=" ../../css/generaal.css">
<link rel="stylesheet" href=" ../../css/iniciarsesion1.css">

</head>

<body>

<div class="detalle">

    <h2>REGISTRAR PRODUCTO</h2>

    <p class="mensaje-ok">
        <?php echo $mensaje; ?>
    </p>

    <form id="formContacto"
        method="POST"
        enctype="multipart/form-data">

        <label>COD_PROVEEDOR</label>

        <input
            type="text"
            name="cod_proveedor"
            required>

        <br><br>
        <label>NOMBRE</label>

        <input
            type="text"
            name="nombre"
            required>

        <br><br>

        <label>PRECIO_COMPRA</label>

        <input
            type="text"
            name="precio_compra"
            required>

        <br><br>

        <label>PRECIO_VENTA</label>

        <input
            type="text"
            name="precio_venta"
            required>

        <br><br>

       <label>PRESENTACION</label>

        <select name="presentacion" required>

            <option value="">
                Seleccione...
            </option>

            <option value="solido">
                solido
            </option>

            <option value="liquido">
                liquido
            </option>

            <option value="semi-liquido">
                semi-liquido
            </option>

            <option value="gaseoso">
               gaseoso
            </option>


        </select>

        <br><br>

         <label>CANTIDAD</label>

        <input
            type="number"
            name="cantidad"
            min="0"
            required>

        <br><br>

        <label>IMAGEN</label>

        <input
            type="file"
            name="imagen"
            accept=".jpg,.jpeg,.png,.webp"
            required>

        <br><br>

           <label>DESCRIPCION</label>

        <input
            type="text"
            name="descripcion"
            required>

        <br><br>

        
        <label>CATEGORIA</label>

        <input
            type="text"
            name="categoria"
            required>

        <br><br>
        <button
            type="submit"
            name="guardar">

            Guardar Producto

        </button>

      <a href="productos_admin.php">
            Volver
        </a>

    </form>

</div>

</body>
</html>