<!DOCTYPE html>
<html lang="es">

<head>
    <style>
        body {
            background-color: #949393;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharMago</title>
    <link rel="stylesheet" href="../css/registro1.css">
</head>

<header class="navbar">
    <div class="contenedor">
        <img loading="lazy" src="../imagenes/videoYslogans/logoblanco.png" alt="logo" width="100" height="100">
    </div>

    <div class="contenedor5">
        <a href="../php/soporte.php"><button id="boton">CONTACTAR AL
                SOPORTE</button></a>
    </div>

    <h1 id="titulo"><strong>PharMago</strong></h1>
    <main id="INICIO">
        <main id="CATALOGO">
            <nav>
                <a href="../index.php">INICIO</a>
                <a href="catalogo.php">CATALOGO</a>
                <a href="../registro.php">REGISTRO </a>
                <a href="../iniciarsesion.php">INICIAR SESION</a>
            </nav>
        </main>
    </main>
</header>


<!-- Contacto -->
<section id="contacto">
    <h2>Formulario de Contacto</h2>
    <form id="formContacto">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" required>
        <br><br>
        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" rows="4" required></textarea>
        <br><br>
        <button type="submit">Enviar</button>
    </form>
</section>
<footer>
  Contactanos al: +57 xxxxxxxxx o: PharmaHub_official en las redes
<br></br>
<div class="ejemplo">
    <div class="derechos">
      <p>&copy; 2025 <span class="titulo-animado">PharmaHub</span> | Desarrollado en el programa Técnico en Programación de Software.</p>
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