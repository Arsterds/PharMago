<?php
session_start();
Include("../conexion.php");


if(!isset($_SESSION["usuario"]) || $_SESSION["rol"]!="cliente")
    {
        header("Location:../iniciarsesion.php");
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
    <title>Perfil | PharMago</title>
    <link rel="icon" href="./imagenes/logo.png" type="image/png">
    <link rel="stylesheet" href="../css/general_perfil.css">
</head>
          <header>
        <div class="contenedor">
            <img src="../imagenes/logo.png" alt="Logo PharMago">
        </div>
        <div class="contenedor1">
            <a href="./soporte.php" class="button">
                CONTACTAR AL SOPORTE
            </a>
        </div>
        <h1>PharMago</h1>
        <nav>
            <a href="./index_usuario.php">INICIO</a>
            <a href="./usu_catalogo.php">CATÁLOGO</a>
            <a href="./comunidad.php">COMENTARIOS</a>
                        <a href="./perfil.php" class="button">
                MI PERFIL
            </a>
        </nav>
    </header>
<body>
    <div class="card">
    <h2>PERFIL ADMINISTRADOR </h2>
    <p><b>NOMBRE: </b><?php echo $admin ["nombre"];?></p>
    <p><b>APELLIDO: </b><?php echo $admin ["apellido"];?></p>
    <p><b>USUARIO: </b><?php echo $admin ["usuario"];?></p>
    <p><b>TIPO DE DOCUMENTO: </b><?php echo $admin ["tipo_documento"];?></p>
    <p><b>EMAIL: </b><?php echo $admin ["email"];?></p>
    <p><b>NUMERO: </b><?php echo $admin ["numero"];?></p>
    <p><b>DOCUMENTO: </b><?php echo $admin ["documento"];?></p>
    <br>
    <a href="usu_editar.php" class= "btn editar">EDITAR PERFIL </a>
    <a href="../cerrarsesion.php" class="btn baja" onclick="return confirm('¿Desea cerrar sesion?');">CERRAR SESION</a>
    <a href="index_usuario.php" class="btn volver">VOLVER </a>
</div>
    <footer>
        <p>
            Contáctanos al:
            +57 xxxxxxxxx o PharMago_official en las redes sociales.
        </p>
        <p>
            © 2025 <strong>PharMago</strong> |
            Desarrollado en el programa Técnico en Programación de Software.
        </p>
        <p>
            Este sitio web utiliza imágenes y recursos con fines educativos.
            Créditos a
            <a href="https://pixabay.com" target="_blank">Pixabay</a>,
            <a href="https://google.com" target="_blank">Google</a>,
            <a href="https://youtube.com" target="_blank">YouTube</a>.
        </p>
    </footer>
</body>
</html>