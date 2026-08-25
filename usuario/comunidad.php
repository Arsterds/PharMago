<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios | PharMago</title>
    <link rel="icon" href="../imagenes/logo.png" type="image/png">
<link rel="stylesheet" href="../css/general_admin.css">
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
    <!---CONSTRUCCION LOGICA EN PHP-->
        <?php
            session_start();
            Include("../conexion.php");

            If (!isset($_SESSION["usuario"]) || $_SESSION["rol"]!="cliente")
                {
                    header("Location:iniciarsesion.php");
                    exit();
                }
            // consulta de usuarios
            $activos=$conn->query("Select * from mensajes where estado='Activo'");

            $usuarios=$conn->query("Select * from mensajes");
            $conn->close();
         ?>


    <!---CONSTRUCCION HTML -->
    <h2 style="text-align:center; ">COMENTARIOS </h2>
    <table border="1" width="80%" align="center">
        <tr><th>USUARIO</th><th>MENSAJE</th><tr>
         <?php while($row= $activos->fetch_assoc())
         {
            ?>
            <tr>
            <td><?php echo $row["usuario"];?></td>
            <td><?php echo $row["mensaje"];?></td>
           
        </tr>
        <?php } ?>
    </table>
    <br>
    <div class="footer">
    <a href="./index_usuario.php">VOLVER</a>
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