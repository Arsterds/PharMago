<!--logica en php-->
  <?php
  //enlazando la basede datos - conexion
  include("conexion.php");
  //inicializar variable
  $mensaje = "";
  //asignar valores del formulario a variables
  if (isset($_POST["registrar"])) {
    $cod_cliente = $_POST["cod_cliente"];
    $mensaje_usu = $_POST["Mensaje"];

    //validacion de datos
    if ($cod_cliente == "" || $mensaje_usu == "") {
      $mensaje = "todos los campos son obligatorios";
    } 
        //insertar registro en la tabla 
        $stmt = $conn->prepare("insert into mensajes(cod_cliente, mensaje)values(?,?)");
        $stmt->bind_param("ss", $cod_cliente, $mensaje_usu);
        if ($stmt->execute()) {
          $mensaje = "mensaje enviado";
        } else {
          $mensaje = "error al enviar el mensaje";
        }
        $stmt->close();
      }
  // cierre de la conexion con la base de datos
  $conn->close();


  ?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharMago</title>

    <link rel="icon" href="./imagenes/logo.png" type="image/png">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/registro.css">
</head>

<body>
    <!-- ENCABEZADO -->
    <header>
        <div class="contenedor">
            <img src="imagenes/logo.png" alt="Logo PharMago">
        </div>
        <div class="contenedor1">
            </a>
        </div>
        <h1>PharMago</h1>
        <nav>
            <a href="index.php">INICIO</a>
            <a href="./php/catalogo.php">CATÁLOGO</a>
            <a href="registro.php">REGISTRO</a>
            <a href="iniciarsesion.php">INICIAR SESIÓN</a>
        </nav>
    </header>

    <!-- CONTENIDO -->
  <main>
    <!-- Contacto -->
  <section id="contacto" class="registro">
    <h1><?php echo $mensaje?></h1>
    <br>


    <form id="formContacto"  method="POST">
      <div class="form-group">
        <label for="cod_cliente">Codigo de usuario :</label>
        <input type="text" id="cod_cliente" name="cod_cliente">
      </div>
      <br><br>

        <div class="form-group half-width">
          <label for="identificacion">Mensaje:</label>
          <input type="text" id="identificacion" name="Mensaje">
        </div>
      </div>
      <br><br>
      <button name="registrar" type="submit">Enviar</button>
    </form>
  </section>
  </main>

   <!-- PIE -->
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

    <!-- SCRIPT -->
    <script src="js/registro.js"></script>

</body>

</html>