<!--logica en php-->
  <?php
  //enlazando la basede datos - conexion
  include("conexion.php");
  //inicializar variable
  $mensaje = "";
  //asignar valores del formulario a variables
  if (isset($_POST["registrar"])) {
    $nombre = $_POST["nombre"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $usuario = $_POST["nombre_de_usuario"];
    $tipo_doc = $_POST["tipoDocumento"];
    $documento = $_POST["identificacion"];
    $contacto = $_POST["telefono"];
    $correo = $_POST["correo"];
    $contras = $_POST["contrasena"];
    $con_contras = $_POST["confirmar_contrasena"];

    //validacion de datos
    if ($nombre == "" || $apellido1 == "" || $apellido2 == "" || $usuario == "" || $tipo_doc == "" || $documento == "" || $contacto == "" || $correo == "" || $contras == "" || $con_contras == "") {
      $mensaje = "todos los campos son obligatorios";
    } 
    
    
    else {
      //vereficacion si el correo existe - consulta en la tabla cliente
      $verificar = $conn->prepare("select cod_cliente from clientes where correo=?");
      $verificar->bind_param("s", $correo);
      $verificar->execute();
      $verificar->store_result();
      if ($verificar->num_rows > 0) {
        $mensaje = "el correo ingresado ya esta registrado";
      } else {
        // si no encuentro el correo registrado, encripta la contraseña para el registro
        $contra_segura = password_hash($contras, PASSWORD_DEFAULT);
        $rol = "cliente";
        //insertar registro en la tabla 
        $stmt = $conn->prepare("insert into clientes(nombre,apellido,usuario,correo,contraseña,contra_encriptada,numero,tipo_documento,documento,rol)values(?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssssss", $nombre, $apellido1, $usuario, $correo, $contras, $contra_segura, $contacto, $tipo_doc, $documento, $rol);
        if ($stmt->execute()) {
          $mensaje = "usuario registrado con exito..";
        } else {
          $mensaje = "error al registrar";
        }
        $stmt->close();
      }
      $verificar->close();
    }

  }
  // cierre de la conexion con la base de datos
  $conn->close();


  ?>
  
<!DOCTYPE html>
<html lang="es">

<head>
  <style>

  </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PharMago</title>
  <link rel="stylesheet" href="./css/registro1.css">
  
</head>

<header class="navbar">
  <div class="contenedor">
    <img loading="lazy" src="imagenes/videoYslogans/logoblanco.png" alt="logo" width="100" height="100">
  </div>

  <div class="contenedor5">
    <a href="./php/soporte.php"><button id="boton">CONTACTAR AL
        SOPORTE</button></a>
  </div>

  <h1 id="titulo"><strong>PharMago</strong></h1>
  <main id="INICIO">
    <main id="CATALOGO">
      <nav>
        <a href="index.php">INICIO</a>
        <a href="./php/catalogo.php">CATALOGO</a>
        <a href="registro.php">REGISTRO </a>
        <a href="iniciarsesion.php">INICIAR SESION</a>
      </nav>
    </main>
  </main>
</header>

<body>


  <!-- Contacto -->
  <section id="contacto">
    <h1><?php echo $mensaje?></h1>
    <br>


    <form id="formContacto"  method="POST">

      <div class="form-group">
        <label for="nombre">Nombre(s):</label>
        <input type="text" id="nombre" name="nombre">
      </div>
      <br><br>

      <div class="form-row">
        <div class="form-group half-width">
          <label for="apellido1">Primer Apellido:</label>
          <input type="text" id="apellido1" name="apellido1">
        </div>


        <div class="form-group half-width">
          <label for="apellido2">Segundo Apellido:</label>
          <input type="text" id="apellido2" name="apellido2">
        </div>
      </div>
      <br><br>



      <div class="form-group">
        <label for="nombre_de_usuario">Usuario :</label>
        <input type="text" id="nombre_de_usuario" name="nombre_de_usuario">
      </div>
      <br><br>

      <!-- Tipo y número de documento en la misma línea -->
      <div class="form-row">
        <div class="form-group half-width">
          <label for="tipoDocumento">Tipo de documento:</label>
          <select id="tipoDocumento" name="tipoDocumento">
            <option value="">Seleccione...</option>
            <option value="CC">Cédula de ciudadanía</option>
            <option value="TI">Tarjeta de identidad</option>
            <option value="CE">Cédula de extranjería</option>
            <option value="NIT">NIT</option>
          </select>
        </div>

        <div class="form-group half-width">
          <label for="identificacion">N° de identificación:</label>
          <input type="text" id="identificacion" name="identificacion">
        </div>
      </div>
      <br><br>




      <div class="form-group">
        <label for="telefono"> Numero de telefono :</label>
        <input type="text" id="telefono" name="telefono">
      </div>
      <br><br>
      <div class="form-group">
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo">
      </div>
      <br><br>
      <div class="form-group">
        <label for="contrasena">Ingresa una contraseña:</label>
        <input type="password" id="contrasena" name="contrasena">
      </div>
      <br><br>
      <div class="form-group">
        <label for="confirmar_contrasena">Confirmar contraseña:</label>
        <input type="password" id="confirmar_contrasena" name="confirmar_contrasena">
      </div>
      <br><br>

      <button name="registrar" type="submit">Enviar</button>
    </form>
  </section>


  








</body>
<footer>
  Contactanos al: +57 xxxxxxxxx o: PharmaHub_official en las redes
  <br></br>
  <div class="ejemplo">
    <div class="derechos">
      <p>&copy; 2025 <span class="titulo-animado">PharmaHub</span> | Desarrollado en el programa Técnico en Programación
        de Software.</p>
      <p>
        Este sitio web utiliza imágenes y recursos con propósitos de aprendizaje.
        Créditos a <a href="https://pixabay.com" target="_blank">Pixabay</a>,
        <a href="https://www.google.com/" target="_blank">Google</a>,
        <a href="https://youtube.com" target="_blank">YouTube</a>,
        y fuentes de libre uso en la web.
      </p>
    </div>
  </div>

</footer>

</html>